<?php

namespace Delivery\Http\Controllers\Api;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\CouponRepository;

class CouponController extends Controller
{
	private $couponRepository;

	public function __construct(
		CouponRepository $couponRepository
		)
	{
		$this->couponRepository = $couponRepository;
	}

	public function show($code)
	{
		$coupon = $this->couponRepository->skipPresenter(false)->findByCode($code);
		return $coupon;
	}
}
