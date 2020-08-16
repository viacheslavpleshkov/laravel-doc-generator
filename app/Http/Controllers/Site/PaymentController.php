<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\PaymentRequest;
use App\Repositories\OrderRepository;
use App\Repositories\SituationRepository;
use App\Repositories\UserFillInputRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Idma\Robokassa\Payment;
use App\Notifications\InvoicePaid;

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
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var
     */
    protected $orderRepository;

    /**
     * PaymentController constructor.
     * @param SituationRepository $situationRepository
     * @param UserFillInputRepository $userFillInputRepository
     * @param UserRepository $userRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(SituationRepository $situationRepository,
                                UserFillInputRepository $userFillInputRepository,
                                UserRepository $userRepository,
                                OrderRepository $orderRepository)
    {
        $this->payment = new Payment(
            config('app.robokassa_login'),
            config('app.robokassa_password1'),
            config('app.robokassa_password2'),
            config('app.robokassa_mode')
        );
        $this->situationRepository = $situationRepository;
        $this->userFillInputRepository = $userFillInputRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $situations = $this->situationRepository->getById($request->id);
        $main = $this->userFillInputRepository
            ->where('user_id', Auth::user()->id)
            ->where('situation_id', $request->id)
            ->get();

        return view('site.payment.index', [
            'situations' => $situations,
            'main' => $main
        ]);
    }

    /**
     * @param PaymentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Idma\Robokassa\Exception\InvalidSumException
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function submit(PaymentRequest $request)
    {
        $situations = $this->situationRepository->getById($request->id);
        $user_id = Auth::user()->id;
        $this->userRepository->update($user_id, ['email_pay' => $request->email]);
        $transaction = (new DocumentController())->create_document($user_id, $situations->id);
        $this->payment
            ->setInvoiceId($transaction->id)
            ->setSum($situations->price)
            ->setDescription($situations->description);

        return redirect()->route('site.payment.success', ['id' => $transaction->id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
        $order = $this->orderRepository->getById($request->id);
        if (isset($order)) {
            $this->orderRepository->update($request->id, ['status' => 1]);
            $order = $this->orderRepository->getById($request->id);
            $user = $this->userRepository->getById(Auth::user()->id);
            $user->notify(new InvoicePaid($order));

            return view('site.payment.success', compact('order'));
        } else
            abort(404);
    }
}
