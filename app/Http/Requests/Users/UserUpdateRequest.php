<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UserUpdateRequest extends FormRequest {
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

        Validator::extend('not_contains', function ($attribute, $value, $parameters) {
            // Banned words
            $words = array('admin', 'superadmin', 'owner');
            foreach ($words as $word) {
                if (stripos($value, $word) !== false) return false;
            }
            return true;
        });

        $messages = array(
            'not_contains' => 'The :attribute must not contain banned words',
        );

        $rules = [
            'name' => 'required',
            'email' => 'unique:users,email,' . $this->id,
            'mobile' => 'required|digits:11|regex:/(01)[0-9]{9}/|unique:users,mobile,' . $this->id
        ];
        if ($this->has('role_id')) {
            $rules['role_id'] = 'required';
        }
        return $rules;
    }

    public function messages(): array {
        return [
            'username.not_contains' => 'The :attribute must not contain banned words',
        ];
    }
}
