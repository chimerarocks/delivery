<?php

namespace Delivery\Presenters;

use Delivery\Transformers\CouponTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CouponPresenter
 *
 * @package namespace Delivery\Presenters;
 */
class CouponPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CouponTransformer();
    }
}
