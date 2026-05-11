<?php

namespace App\Filament\Admin\Resources\MahasiswaResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMahasiswaRequest extends FormRequest
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
			'nim' => 'required',
			'jurusan' => 'required',
			'alamat' => 'required|string',
			'no_hp' => 'required'
		];
    }
}
