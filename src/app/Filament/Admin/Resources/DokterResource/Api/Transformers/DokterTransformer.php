<?php
namespace App\Filament\Admin\Resources\DokterResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Dokter;

/**
 * @property Dokter $resource
 */
class DokterTransformer extends JsonResource
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
