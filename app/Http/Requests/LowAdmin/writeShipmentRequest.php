<?php

namespace App\Http\Requests\LowAdmin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class writeShipmentRequest extends FormRequest
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
    public function rules()
    {
        return [
            'warehouse_name' => 'required',
            'worker_id'=>'required',
            'product_name'=>'required',
            'product_id' => 'required',
            'product_num' => 'required|int',
            'send_place' => 'required'
        ];

    }
    protected  function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail(422, '参数错误',$validator->errors()->all(),422)));
    }
}
