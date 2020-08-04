<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractRequest;

/**
 * Class DocumentFileStoreRequest
 * @package App\Http\Requests\Admin
 */
class DocumentFileStoreRequest extends AbstractRequest
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
            'file_path' => 'required|file|mimes:pdf,docx,doc',
        ];
    }
}