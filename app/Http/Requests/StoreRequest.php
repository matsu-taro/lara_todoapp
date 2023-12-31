<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'new_owner_name' => 'nullable',
            'owner_name'=>'owner_name_check',
            'files' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'title' => 'タイトルは必ず記入してください。',
            'content' => '内容は必ず記入してください。',
            'owner_name_check' => '担当者は1人決めてください。'
        ];
    }
}
