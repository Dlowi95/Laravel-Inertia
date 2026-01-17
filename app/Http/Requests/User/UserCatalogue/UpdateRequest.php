<?php

namespace App\Http\Requests\User\UserCatalogue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => "required|string",
            'canonical' => [
                "required",
                "string",
                Rule::unique('user_catalogues')->ignore($this->route('user_catalogue'))
            ],
            'description' => "sometimes|string"
        ];
    }
    public function attributes()
    {
        return [
            'name' => Lang::get('messages.user_catalogue.name'),
            'canonical' => Lang::get('messages.user_catalogue.canonical')
        ];
    }
}
