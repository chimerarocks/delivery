<?php

namespace Delivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace Delivery\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function updateDeviceToken($user_id, $device_token);
}
