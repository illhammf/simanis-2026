<?php

namespace App\Filament\Admin\Resources\PasienResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePasienRequest extends FormRequest
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
			'nama' => 'required',
			'nik' => 'required',
			'tanggal_lahir' => 'required|date',
			'jenis_kelamin' => 'required',
			'alamat' => 'required|string',
			'no_hp' => 'required'
		];
    }
}
