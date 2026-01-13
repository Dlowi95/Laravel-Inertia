<?php

namespace App\Http\Requests\User\UserCatalogue;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        Log::info('StoreRequest validation rules', ['request_data' => $this->all()]);
        return [
            'name' => "required|string",
            'canonical' => "required|string|unique:user_catalogues",
            'description' => "nullable|string"
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        Log::info('StoreRequest validation failed', ['errors' => $validator->errors()->all()]);
        parent::failedValidation($validator);
    }
    public function attributes()
    {
        return [
            'name' => Lang::get('messages.user_catalogue.name'),
            'canonical' => Lang::get('messages.user_catalogue.canonical')
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'canonical' => Str::slug($this->input('canonical'))
        ]);
    }
}
