<?php

namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\CheckoutRequest;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
	private $orderRepository;
	private $userRepository;
	private $productRepository;
	private $orderService;

	public function __construct(
		OrderRepository $orderRepository,
		UserRepository 	$userRepository,
		ProductRepository $productRepository,
		OrderService $orderService
		)
	{
		$this->orderRepository = $orderRepository;
		$this->userRepository = $userRepository;
		$this->productRepository = $productRepository;
		$this->orderService = $orderService;
	}

	public function index()
	{
		$clientId = $this->userRepository->find(Auth::user()->id)->client->id;
		$orders = $this->orderRepository->scopeQuery(function($query) use ($clientId) {
			return $query->where('client_id', '=', $clientId);
		})->paginate();

		return view('customer.order.index', compact('orders'));
	}

	public function create()
	{
		$products = $this->productRepository->list(['name', 'price', 'id']);
		return view('customer.order.create', compact('products'));
	}

	public function store(CheckoutRequest $request)
	{
		$data = $request->all();
		$clientId = $this->userRepository->find(Auth::user()->id)->client->id;
		$data['client_id'] = $clientId;
		$this->orderService->create($data);

		return redirect()->route('customer.orders.index');
	}
    
}
