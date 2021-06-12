<?php

namespace App\Http\Requests;

use App\Enums\UserEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$this->user,
            'email' => 'required|email|unique:users,email,'.$this->user,
            'admin' => 'in:'.UserEnum::ROLE_USER.','.UserEnum::ROLE_ADMIN
        ];
    }
}
