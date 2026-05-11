<?php

namespace App\Filament\Admin\Resources\SiswaResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
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
			'nisn' => 'required',
			'nis' => 'required',
			'email' => 'required',
			'password' => 'required',
			'tingkat_id' => 'required',
			'jurusan_id' => 'required',
			'kelas_id' => 'required',
			'tahun_ajaran_id' => 'required',
			'status_siswa' => 'required',
			'nilai_rapor' => 'required|numeric',
			'prestasi' => 'required',
			'tanggal_lulus' => 'required|date',
			'alasan_drop' => 'required|string',
			'tanggal_drop' => 'required|date',
			'jalur_masuk' => 'required',
			'asal_sekolah' => 'required',
			'surat_mutasi' => 'required',
			'nilai_prestasi' => 'required|numeric',
			'jenis_prestasi' => 'required',
			'is_yatim_piatu' => 'required',
			'foto' => 'required',
			'deleted_at' => 'required'
		];
    }
}
