<?php

namespace Delivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductRepository
 * @package namespace Delivery\Repositories;
 */
interface ProductRepository extends RepositoryInterface
{
	public function list($column);
}
