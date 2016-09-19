<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\CategoryRepository;
use Delivery\Models\Category;
use Delivery\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    public function list($column)
    {
        $category = $this->model->all();

        $categories = [];

        foreach ($category as $c) {
            $categories[$c->id] = $c->name;
        }

        return $categories;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
