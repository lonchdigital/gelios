<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $locale = session('locale', config('app.locale'));
        app()->setLocale($locale);

        // app()->setLocale(request()->getLocale());

        // Log::info('Request locale: ' . request()->getLocale());
        // Log::info('App locale after update: ' . app()->getLocale());

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'min:10',
                'max:20',
                'regex:/^(\+?380)[\d\s-]{9,}$/i',
            ],

            'doctor' => [
                'required',
                'string',
                'max:255',
            ],

            'clinic' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }

    public function attributes()
    {
        return [
            'phone' => __('validation.phone'),
            'name' => __('validation.name'),
            'doctor' => __('validation.doctor'),
            'clinic' => __('validation.clinic'),
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => __('validation.feedback.phone'),
            'phone.min' => __('validation.feedback.phone.min'),
            'phone.max' => __('validation.feedback.phone,max'),
        ];
    }
}
