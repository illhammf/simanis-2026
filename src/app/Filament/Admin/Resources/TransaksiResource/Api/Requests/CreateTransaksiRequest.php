<?php

namespace App\Filament\Admin\Resources\TransaksiResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransaksiRequest extends FormRequest
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
			'produk_id' => 'required',
			'pelanggan_id' => 'required',
			'tanggal_transaksi' => 'required|date',
			'jumlah' => 'required',
			'total_harga' => 'required',
			'status' => 'required'
		];
    }
}
