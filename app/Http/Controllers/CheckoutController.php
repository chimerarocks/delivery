<?php

namespace Delivery\Http\Controllers;

use Delivery\Http\Requests;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	private $orderRepository;
	private $userRepository;
	private $productRepository;

	public function __construct(
		OrderRepository $orderRepository,
		UserRepository 	$userRepository,
		ProductRepository $productRepository
		)
	{
		$this->orderRepository = $orderRepository;
		$this->userRepository = $userRepository;
		$this->productRepository = $productRepository;
	}

	public function create()
	{
		$products = $this->productRepository->list(['name', 'price', 'id']);
		return view('customer.order.create', compact('products'));
	}
    
}
