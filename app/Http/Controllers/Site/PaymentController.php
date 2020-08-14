<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\PaymentRequest;
use App\Repositories\SituationRepository;
use App\Repositories\UserFillInputRepository;
use Illuminate\Http\Request;
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
     * @var UserFillInputRepository
     */
    protected $userFillInputRepository;
    /**
     * @var Payment
     */
    protected $payment;

    /**
     * PaymentController constructor.
     * @param SituationRepository $situationRepository
     * @param UserFillInputRepository $userFillInputRepository
     */
    public function __construct(SituationRepository $situationRepository,
                                UserFillInputRepository $userFillInputRepository)
    {
        $this->payment = new Payment(
            config('app.robokassa_login'),
            config('app.robokassa_password1'),
            config('app.robokassa_password2'),
            config('app.robokassa_mode')
        );
        $this->situationRepository = $situationRepository;
        $this->userFillInputRepository = $userFillInputRepository;
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
        if (Auth::check())
            $user_id = Auth::user()->id;
        else
            $user_id = 1;
        $situations = $this->situationRepository->getById($id);

        $main = $this->userFillInputRepository
            ->where('user_id', $user_id)
            ->where('situation_id', $id)
            ->get();

        return view('site.payment.index', [
            'situations' => $situations,
            'main' => $main
        ]);
    }

    public function submit(PaymentRequest $request) {
        dd($request);
        $situations = $this->situationRepository->getById($id);
        $transaction =  (new DocumentController())->create_document($user_id, $situations->id);

        $this->payment
            ->setInvoiceId($request->transaction)
            ->setSum($situations->price)
            ->setDescription($situations->description);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function success(Request $request)
    {
        dd($request);
        $user_id = $request->$id;
        $transaction = $request->transaction;
        $situation_id = $request->situation_id;
        $file = (new DocumentController())->index($transaction, $user_id);
        return view('site.payment.success', [

        ]);
    }
}
