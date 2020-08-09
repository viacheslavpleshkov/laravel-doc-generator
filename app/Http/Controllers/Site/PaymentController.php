<?php

namespace App\Http\Controllers\Site;

use App\Models\User_fill_input;
use App\Repositories\SituationRepository;
use Illuminate\Support\Facades\Auth;
use Idma\Robokassa\Payment;
/**
 * Class PaymentController
 * @package App\Http\Controllers\Site
 */
class PaymentController extends BaseController
{
    /**
     * @var SituationRepository
     */
    protected $situationRepository;
    /**
     * @var User_fill_input
     */
    protected $user_fill_input;
    /**
     * @var Payment
     */
    protected $payment;

    /**
     * PaymentController constructor.
     * @param SituationRepository $situationRepository
     */
    public function __construct(SituationRepository $situationRepository)
    {
        $this->payment = new Payment(
            config('app.robokassa_login'),
            config('app.robokassa_password1'),
            config('app.robokassa_password2'),
            config('app.robokassa_mode')
        );
        $this->situationRepository = $situationRepository;
        $this->user_fill_input = new User_fill_input();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Idma\Robokassa\Exception\EmptyDescriptionException
     * @throws \Idma\Robokassa\Exception\InvalidInvoiceIdException
     * @throws \Idma\Robokassa\Exception\InvalidSumException
     */
    public function index($id)
    {
        $situations = $this->situationRepository->getById($id);
        $main = $this->user_fill_input->where('user_id', Auth::user()->id)->where('situation_id', $id)->get();
        $this->payment
            ->setInvoiceId($situations->id)
            ->setSum($situations->price)
            ->setDescription($situations->description);

        return view('site.payment.index', [
            'url' => $this->payment->getPaymentUrl(),
            'situations' => $situations,
            'main' => $main
        ]);
    }
}
