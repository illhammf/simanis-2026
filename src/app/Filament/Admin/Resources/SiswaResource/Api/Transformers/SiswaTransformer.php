<?php
namespace App\Filament\Admin\Resources\SiswaResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Siswa;

/**
 * @property Siswa $resource
 */
class SiswaTransformer extends JsonResource
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
