<?php

namespace Delivery\Http\Controllers\Api\Deliveryman;

use Delivery\Http\Controllers\Controller;
use Delivery\Models\Geo;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliverymanCheckoutController extends Controller
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
		$id = Auth::user()->id;
		$orders = $this->orderRepository
			->skipPresenter(false)
			->with($this->items)
			->scopeQuery(function($query) use ($id) {
				return $query->where('user_deliveryman_id', '=', $id);
			})->paginate();

		return $orders;
	}
    
    public function show($id)
    {
    	$order = $this->orderRepository
    		->skipPresenter(false)
    		->getByIdAndDeliveryman($id, Auth::user()->id);
    	return $order;
    }

    public function updateStatus(Request $request, $id)
    {
    	return $this->orderService
    		->updateStatus($id, Auth::user()->id, $request->get('status'));
    }

    public function geo(Request $request, Geo $geo, $id)
    {
    	$order = $this->orderRepository->getByIdAndDeliveryman($id, Auth::user()->id);
    	$geo->lat = $request->get('lat');
    	$geo->long = $request->get('long');
    	event(new GetLocationDeliveryman($geo, $order));
    	return $geo;
    }
}
