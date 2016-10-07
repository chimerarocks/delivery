<?php

namespace Delivery\Repositories;

use Delivery\Models\Coupon;
use Delivery\Presenters\CouponPresenter;
use Delivery\Repositories\CouponRepository;
use Delivery\Validators\CouponValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CouponRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class CouponRepositoryEloquent extends BaseRepository implements CouponRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coupon::class;
    }

    public function presenter()
    {
        return CouponPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findByCode($code)
    {
        $result = $this->model->where('code', $code)->where('used',0)->first();

        if ($result) {
            return $this->parserResult($result);
        }

        throw (new ModelNotFoundException)->setModel(get_class($this->model));
        ;
    }
}
