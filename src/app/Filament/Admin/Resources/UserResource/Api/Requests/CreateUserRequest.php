<?php

namespace App\Filament\Admin\Resources\UserResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
			'avatar_url' => 'required',
			'name' => 'required',
			'username' => 'required',
			'email' => 'required',
			'email_verified_at' => 'required',
			'password' => 'required',
			'remember_token' => 'required',
			'theme' => 'required',
			'theme_color' => 'required'
		];
    }
}
