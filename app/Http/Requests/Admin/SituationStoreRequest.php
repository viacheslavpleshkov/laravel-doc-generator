<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractRequest;

/**
 * Class SituationStoreRequest
 * @package App\Http\Requests\Admin
 */
class SituationStoreRequest extends AbstractRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer',
            'type_id' => 'required|integer',
            'document_file_id' => 'required|integer',
        ];
    }
}