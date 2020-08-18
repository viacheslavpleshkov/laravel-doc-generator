<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SettingRepository;
use App\Repositories\OrderRepository;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class OrderController
 * @package App\Http\Controllers\Admin
 */
class OrderController extends BaseController
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * OrderController constructor.
     * @param OrderRepository $orderRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(OrderRepository $orderRepository,
                                SettingRepository $settingRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = $this->settingRepository->getPaginateAdmin();
        $main = $this->orderRepository->getAdminAll($paginate);

        return view('admin.orders.index', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $main = $this->orderRepository->getById($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') show order id= ' . $main->id);

        return view('admin.orders.show', compact('main'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $main = $this->orderRepository->getById($id);

        return view('admin.orders.edit', compact('main', 'users'));
    }

    /**
     * @param OrderUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        $this->orderRepository->update($id, $request->all());
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy order id= ' . $id);

        return redirect()->route('orders.index')->with('success', __('admin.updated-success'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->orderRepository->delete($id);
        Log::info('admin(role: ' . Auth::user()->role->name . ', id: ' . Auth::user()->id . ', email: ' . Auth::user()->email . ') destroy order id= ' . $id);

        return redirect()->route('orders.index')->with('success', __('admin.information-deleted'));
    }
}