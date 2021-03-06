<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        return $ruls = [
            'name' => 'required',
            'price' => 'required',

        ];
    }
    public function messages()
    {

            return $message = [
            'name.required' => __('message.The name field is required'),
            'price.required' =>__('message.The price field is required'),


];
    }
}
