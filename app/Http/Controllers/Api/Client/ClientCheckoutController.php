<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\CheckoutRequest as Request;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class ClientCheckoutController extends Controller
{
	private $orderRepository;
	private $userRepository;
	private $orderService;
	private $with = ['client', 'coupon', 'items'];

	public function __construct(
		OrderRepository $orderRepository,
		UserRepository 	$userRepository,
		OrderService $orderService
		)
	{
		$this->orderRepository = $orderRepository;
		$this->userRepository = $userRepository;
		$this->orderService = $orderService;
	}

	public function index()
	{
		$clientId = $this->userRepository->find(Auth::user()->id)->client->id;
		$orders = $this->orderRepository
			->skipPresenter(false)
			->with($this->with)
			->scopeQuery(function($query) use ($clientId) {
				return $query->where('client_id', '=', $clientId);
			})->paginate();

		return $orders;
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$clientId = $this->userRepository->find(Auth::user()->id)->client->id;
		$data['client_id'] = $clientId;
		$o = $this->orderService->create($data);
		$order = $this->orderRepository
			->with($this->with)
			->find($o->id);

		return $order;
	}
    
    public function show($id)
    {
    	return $this->orderRepository
    		->skipPresenter(false)
    		->with($this->with)
    		->find($id);
    }
}
