<?php

namespace App\Filament\Admin\Resources\PeminjamanResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePeminjamanRequest extends FormRequest
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
			'mahasiswa_id' => 'required',
			'buku_id' => 'required',
			'tanggal_pinjam' => 'required|date',
			'tanggal_kembali' => 'required|date',
			'status' => 'required'
		];
    }
}
