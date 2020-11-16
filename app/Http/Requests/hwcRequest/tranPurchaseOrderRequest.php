<?php

namespace App\Http\Requests\hwcRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class tranPurchaseOrderRequest extends FormRequest
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

    public function rules()
    {
        return [
            'unenough_warehouse' => 'required|string',
            'enough_warehouse' => 'required|string',
            'management' => 'required|string',
            'product_name' => 'required|string',
            'product_id' => 'required|string',
            'product_num' => 'required|int',
            'token' => 'required|string',
        ];
    }
    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail('参数错误!',$validator->errors()->all(),422)));
    }
}
