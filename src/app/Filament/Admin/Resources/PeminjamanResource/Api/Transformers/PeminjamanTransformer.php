<?php
namespace App\Filament\Admin\Resources\PeminjamanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Peminjaman;

/**
 * @property Peminjaman $resource
 */
class PeminjamanTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
