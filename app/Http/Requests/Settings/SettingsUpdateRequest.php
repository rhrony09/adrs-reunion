<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest {
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
        $rules = [
            'site_name' => 'required',
            'site_tagline' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:11',
            'site_primary_color' => 'required',
            'site_accent_color' => 'required',
            'site_secondary_color' => 'required',
            'site_secondary_accent_color' => 'required',
        ];

        if ($this->has('logo_dark')) {
            $rules['logo_dark'] = 'required|mimes:png';
        }

        if ($this->has('logo_light')) {
            $rules['logo_light'] = 'required|mimes:png';
        }

        if ($this->has('favicon')) {
            $rules['favicon'] = 'required|mimes:png';
        }

        return $rules;
    }
}
