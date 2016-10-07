<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\UserRepository;
use Delivery\Models\User;
use Delivery\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getDeliveryMen()
    {
        $deliveryman = $this->model->where(['role' => 'deliveryman'])->get();

        $deliverymen = [];

        foreach ($deliveryman as $d) {
            $deliverymen[$d->id] = $d->name;
        }

        return $deliverymen;
    }

    public function presenter()
    {
        return \Delivery\Presenters\UserPresenter::class;
    }
}
