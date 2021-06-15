<?php

namespace App\Http\Requests;

use App\Enums\LessonEnum;
use Illuminate\Foundation\Http\FormRequest;

class PostLessonRequest extends FormRequest
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
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'provider_video' => 'required|in:'.LessonEnum::PROVIDER_YOUTUBE.','.LessonEnum::PROVIDER_VIMEO,
            'video_link' => 'required|url',
            'init_date' => 'required|date'
        ];
    }
}
