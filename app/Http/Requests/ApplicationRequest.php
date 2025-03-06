<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'advertisement_id' => 'required|exists:advertisements,id',
            'optional_subject' => 'nullable|string|max:100',
            'is_appearing_upsc_cse' => 'boolean',
            'upsc_attempts' => 'required_if:is_appearing_upsc_cse,true|array',
            'upsc_attempts.*.exam_year' => 'required|digits:4',
            'upsc_attempts.*.roll_number' => 'required|string',
            'employment_history' => 'array',
            'current_enrollment' => 'array',
        ];
    }
}