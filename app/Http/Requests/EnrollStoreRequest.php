<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollStoreRequest extends FormRequest {
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
            'name' => 'required',
            'mobile' => 'required|regex:/(01)[0-9]{9}/|unique:enrolls,mobile',
            'batch' => 'required',
            'payment_method' => 'required',
        ];
        if (request()->payment_method == 'bkash') {
            $rules['transaction'] = 'required';
        }
        return $rules;
    }

    public function messages() {
        return [
            'name.required' => 'অনুগ্রহ করে আপনার নাম লিখুন',
            'mobile.required' => 'অনুগ্রহ করে আপনার মোবাইল নম্বর লিখুন',
            'mobile.regex' => 'অনুগ্রহ করে সঠিক মোবাইল নম্বর লিখুন',
            'mobile.unique' => 'দুঃখিত, মোবাইল নাম্বারটি ইতিমধ্যে ব্যবহার করা হয়েছে',
            'batch.required' => 'অনুগ্রহ করে আপনার ব্যাচ সিলেক্ট করুন',
            'payment_method.required' => 'অনুগ্রহ করে পেমেন্ট মেথড সিলেক্ট করুন',
            'transaction.required' => 'অনুগ্রহ করে বিকাশ অথবা ট্রানজেকশন নম্বর লিখুন'
        ];
    }
}
