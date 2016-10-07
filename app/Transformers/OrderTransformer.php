<?php

namespace Delivery\Transformers;

use Delivery\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['coupon', 'items', 'client'];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,
            'total'      => (float) $model->total,
            'product_names' => $this->getArrayProductNames($model->items),
            'status'     => $model->status,
            'hash'       => $model->hash,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    protected getArrayProductNames(Collection $items)
    {
        $names = [];
        foreach ($items as $item) {
            $names[] = $item->product->name;
        }
        return $names;
    }

    public function includeClient(Order $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeCoupon(Order $model)
    {
        if (!$model->coupon) {
            return null;
        }
        return $this->item($model->coupon, new CouponTransformer());
    }

    public function includeItems(Order $model)
    {
        return $this->collection($model->items, new OrderItemTransformer());
    }
}
