<?php

namespace Delivery\Services;

use Delivery\Models\Order;
use Delivery\Repositories\CouponRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Dmitrovskiy\IonicPush\PushProcessor;

class OrderService
{
	private $orderRepository;
	private $couponRepository;
	private $productRepository;
	private $pushProcessor;

	public function __construct(
		OrderRepository $orderRepository, 
		CouponRepository$couponRepository, 
		ProductRepository $productRepository, 
		PushProcessor $pushProcessor)
	{
		$this->orderRepository = $orderRepository;
		$this->couponRepository = $couponRepository;
		$this->productRepository = $productRepository;
		$this->pushProcessor = $pushProcessor;
	}

	public function create(array $data)
	{
		\DB::beginTransaction();
		try {
			$data['status'] = 0;
			if (isset($data['coupon_id'])) {
				unset($data['coupon_id']);
			}
			if (isset($data['coupon_code'])) {
				$coupon = $this->couponRepository->findByfield('code', $data['coupon_code'])->first();
				$data['coupon_id'] = $coupon->id;
				$coupon->used = 1;
				$coupon->save();
				unset($data['coupon_code']);
			}

			$items = $data['items'];
			unset($data['items']);

			$total = 0;
			$order = $this->orderRepository->create($data);

			foreach($items as $item) {
				$item['price'] = $this->productRepository->find($item['product_id'])->price;
				$order->items()->create($item);
				$total += $item['price'] * $item['qtd'];
			}

			$order->total = $total;

			if(isset($coupon)){
				$order->total -= $coupon->value;
			}

			$order->save();
			\DB::commit();
			return $order;
		} catch (\Exception $e) {
			\DB::rollback();
			throw $e;
		}
	}

	public function updateStatus($id, $idDeliveryman, $status)
	{
		$order = $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
		$order->status = $status;
		switch((int) $status) {
			case 1:
				if (!$order->hash) {
					$order->hash = md5((new \DateTime())->getTimestamp());
				}
				$order->save();
				break;
			case 2:
				$user = $order->client->user;
				$order->save();
				$this->pushProcessor->notify([$user->device_token],[
					'alert' => 'Seu pedido nº' . $order->id . ' foi entrege'
				]);
				break;
		}
		return $order;
	}
}