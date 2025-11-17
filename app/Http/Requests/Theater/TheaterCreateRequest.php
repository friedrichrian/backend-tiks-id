<?php

namespace App\Http\Requests\Theater;

use Illuminate\Foundation\Http\FormRequest;

class TheaterCreateRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'section' => 'required|integer',
            'col' => 'required|integer',
            'row' => 'required|integer',
        ];
    }
}
