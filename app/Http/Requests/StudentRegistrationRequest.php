<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'secondary_roll' => 'required|max:50',
            // 'first_name' => 'required|max:50',
            // 'last_name' => 'required|max:50',
            // 'gender' => 'required|in:Male,Female,Other',
            // 'dob' => 'required|date|before:-18 years',
            // 'mobile' => 'required|digits:10|unique:students,mobile',
            // 'email' => 'required|email|unique:students,email',
            // 'password' => 'required|confirmed|min:8',

            // Student Profile Fields
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'dob' => 'required|date|before:-18 years',
            'gender' => 'required|in:Male,Female,Others',
            // 'category' => 'required|in:UR,SC,ST,OBC A,OBC B',
            // 'is_pwbd' => 'sometimes|boolean',
            // 'father_name' => 'required|max:100',
            // 'mother_name' => 'required|max:100',
            // 'father_occupation' => 'required|max:100',
            // 'mother_occupation' => 'required|max:100',
            'mobile' => 'required|digits:10|unique:student_profiles,mobile',
            'email' => 'required|email|unique:student_profiles,email',
            // 'alternate_mobile' => 'nullable|digits:10',
            // 'whatsapp' => 'nullable|digits:10',
            // 'alternate_email' => 'nullable|email',
            // 'family_income' => 'nullable|numeric',
            // 'school_language' => 'nullable|string',
            // 'secondary_roll' => 'nullable|string',
            // 'upsc_community' => 'nullable|in:UR,SC,ST,OBC',
            // 'activities' => 'nullable|array',
            // 'hobbies' => 'nullable|array',
            // 'distance' => 'nullable|numeric',
            
            // Authentication Fields
            'password' => 'required|confirmed|min:8',
        ];
    }
}
