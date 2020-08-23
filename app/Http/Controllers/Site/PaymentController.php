<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\Site\PaymentRequest;
use App\Repositories\DocumentFileRepository;
use App\Repositories\OrderRepository;
use App\Repositories\SituationRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserFillInputRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Idma\Robokassa\Payment;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

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
     * @var
     */
    protected $documentFileRepository;
    /**
     * @var TypeRepository
     */
    protected $typeRepository;

    /**
     * PaymentController constructor.
     * @param SituationRepository $situationRepository
     * @param UserFillInputRepository $userFillInputRepository
     * @param UserRepository $userRepository
     * @param OrderRepository $orderRepository
     * @param DocumentFileRepository $documentFileRepository
     * @param TypeRepository $typeRepository
     */
    public function __construct(SituationRepository $situationRepository,
                                UserFillInputRepository $userFillInputRepository,
                                UserRepository $userRepository,
                                OrderRepository $orderRepository,
                                DocumentFileRepository $documentFileRepository,
                                TypeRepository $typeRepository)
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
        $this->documentFileRepository = $documentFileRepository;
        $this->typeRepository = $typeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $situations = $this->situationRepository->getById($request->situation_id);
        $main = $this->userFillInputRepository
            ->where('user_id', Auth::user()->id)
            ->where('situation_id', $request->situation_id)
            ->get();
        $document = $this->documentFileRepository->getById($request->document_id);
        return view('site.payment.index', [
            'situations' => $situations,
            'main' => $main,
            'document' => $document,
            'type_id' => $request->type_url,
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
        $situations = $this->situationRepository->getById($request->situation_id);
        $document = $this->documentFileRepository->getById($request->document_id);
        $user_id = Auth::user()->id;
        $this->userRepository->update($user_id, ['email_pay' => $request->email]);
        $transaction = (new DocumentController())->create_document($user_id, $situations->id, $document);
        $this->payment
            ->setInvoiceId($transaction->id)
            ->setSum($document->price)
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
            Mail::to($user->email_pay)->send(new OrderShipped($order));

            return view('site.payment.success', compact('order'));
        } else
            abort(404);
    }
}
