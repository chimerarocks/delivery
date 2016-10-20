<?php

namespace Delivery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'status' => 'integer',
            'coupon_code' => 'exists:coupons,code,used,0',
        ];
        $this->buildRulesItems(0, $rules);

        $items = $request->get('items', []);

        $items = !is_array($items) ? [] : $items;

        foreach ($items as $key => $value) {
            $this->buildRulesItems($key, $rules);
        }

        return $rules;
    }

    public function buildRulesItems($key, array &$rules)
    {
        $rules["items.$key.product_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';
    }
}
