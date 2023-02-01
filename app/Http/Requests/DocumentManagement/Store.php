<?php

namespace App\Http\Requests\DocumentManagement;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'signing_type' => 'required|in:upload,manual',
            'signing_image' => 'required_if:signing_type,upload|image',
            'signing_manual' => 'required_if:signing_type,manual',
        ];
    }
}
