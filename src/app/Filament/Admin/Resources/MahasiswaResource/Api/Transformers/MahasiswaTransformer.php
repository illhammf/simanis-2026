<?php
namespace App\Filament\Admin\Resources\MahasiswaResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Mahasiswa;

/**
 * @property Mahasiswa $resource
 */
class MahasiswaTransformer extends JsonResource
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
