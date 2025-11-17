<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:movie,title'],
            'description' => ['required', 'string'],
            'duration' => ['required', 'integer'],
            'release_date' => ['required'],
            'poster' => ['required', 'file', 'image', 'max:2048'],
            'genre' => ['required', 'array'],
            'genre.*' => ['exists:genre,id'],
        ];
    }
}
