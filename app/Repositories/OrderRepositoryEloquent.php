<?php

namespace Delivery\Repositories;

use Delivery\Models\Order;
use Delivery\Repositories\OrderRepository;
use Delivery\Validators\OrderValidator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class OrderRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this->with(['items', 'client', 'coupon'])->findWhere(['id' => $id, 'user_deliveryman_id' => $idDeliveryman]);
        if ($result instanceof Collection) {
            $result = $result->first();
        } else {
            if (isset($result['data']) && count($result['data']) == 1) {
                $result['data'] =  $result['data'][0];
            } else {
                throw new ModelNotFoundException("Order não existe", 1);
            }
        }
        return $result;
    }

    public function presenter()
    {
        return \Delivery\Presenters\OrderPresenter::class;
    }
}
