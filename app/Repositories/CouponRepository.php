<?php

namespace Delivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CouponRepository
 * @package namespace Delivery\Repositories;
 */
interface CouponRepository extends RepositoryInterface
{
    public function findByCode($code);
}
