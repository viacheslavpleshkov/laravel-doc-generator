<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\AbstractRequest;

/**
 * Class PaymentRequest
 * @package App\Http\Requests\Site
 */
class PaymentRequest extends AbstractRequest
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
            'email' =>'required|email',
            'checkbox' =>'required',
        ];
    }
}