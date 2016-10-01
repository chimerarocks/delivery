<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\ProductRepository;
use Delivery\Models\Product;
use Delivery\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    public function list($column)
    {
        $product = $this->model->get($column);

        return $product;
        $products = [];

        foreach ($product as $c) {
            $products[$c->id] = $c->name;
        }

        return $products;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
