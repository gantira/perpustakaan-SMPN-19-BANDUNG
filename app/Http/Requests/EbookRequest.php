<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EbookRequest extends FormRequest
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
            'title'         => 'required',
            'author'        => 'required',
            'publisher'     => 'required',
            'isbn'          => 'required',
            'image'         => 'sometimes|mimes:jpg,jpeg',
            'pdf'           => 'required|mimes:pdf',
            'description'   => 'required',
        ];
    }
}
