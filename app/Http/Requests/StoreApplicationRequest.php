<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'personal_details' => 'required|array',
            'personal_details.first_name' => 'required|string|max:255',
            'academic_details' => 'required|array',
            'documents' => 'required|array',
            'documents.*.file' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'program_id' => 'required|exists:programs,id',
            'documents.photo' => 'required|file|mimes:jpg,png|max:2048',
            'documents.signature' => 'required|file|mimes:jpg,png|max:1024',
            'payment.method' => 'required|in:upi,bank_transfer',
            'payment.transaction_id' => 'required|unique:payments,transaction_id'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->student->hasActiveApplication($this->program_id)) {
                $validator->errors()->add(
                    'program_id', 'You already have an active application for this program'
                );
            }
        });
    }
}