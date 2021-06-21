<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicProfileRequest extends FormRequest
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
            'image' => 'nullable|mimes:png,jpg,jpeg|max:5000',
            'active' => 'nullable',
            'linkedin_url' => 'nullable|url',
            'discord_nick' => 'nullable|string',
            'github_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'biography' => 'nullable|string'
        ];
    }
}
