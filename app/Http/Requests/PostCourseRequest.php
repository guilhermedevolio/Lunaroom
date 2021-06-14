<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCourseRequest extends FormRequest
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
            'title' => 'required|unique:courses|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png|max:24000',
            'price' => 'required|integer'
        ];
    }

}
