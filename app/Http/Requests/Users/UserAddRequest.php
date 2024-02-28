<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'mobile' => 'required|digits:11|regex:/(01)[0-9]{9}/|unique:users,mobile,',
            'password' => 'required|min:8',
            'role' => 'required'
        ];
    }
}
