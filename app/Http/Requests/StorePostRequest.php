<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=> ["required","string", "max:100"],
            "desc"=> ["required","string", "max:100"],
        ];
    }


    public function messages()
    {
        return [
             "title.required"=> "Title is required",
             "title.string"=> "Title should be string",
             "title.max"=> "Title max character is 20",
            "desc"=> "desc is required",
        ];
    }
}