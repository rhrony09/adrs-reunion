<?php

namespace App\Http\Requests\Settings;

use App\Models\SocialMedia;
use Illuminate\Foundation\Http\FormRequest;

class SocialMediaUpdateRequest extends FormRequest {
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
        $rules = [];
        foreach (SocialMedia::all() as $social_media) {
            $name = $social_media->name;
            if (request()->$name) {
                $rules[$name] = 'url';
            }
        }
        return $rules;
    }
}
