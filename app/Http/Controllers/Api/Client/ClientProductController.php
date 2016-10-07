<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\ProductRepository;

class ClientProductController extends Controller
{
	private $productRepository;

	public function __construct(
		ProductRepository $productRepository
		)
	{
		$this->productRepository = $productRepository;
	}

	public function index()
	{
		$products = $this->productRepository->skipPresenter(false)->all();
		return $products;
	}
}
