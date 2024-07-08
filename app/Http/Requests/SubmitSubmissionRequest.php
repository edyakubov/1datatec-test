<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitSubmissionRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['present', 'string', 'max:255'],
            'email' => ['present', 'string', 'email', 'max:255'],
            'message' => ['present', 'string'],
        ];
    }
}
