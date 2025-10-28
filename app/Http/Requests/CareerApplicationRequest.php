<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'college' => ['required', 'string', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'plan' => ['nullable', 'string'],
        ];
    }
}
