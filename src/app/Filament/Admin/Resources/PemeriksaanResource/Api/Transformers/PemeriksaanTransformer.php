<?php
namespace App\Filament\Admin\Resources\PemeriksaanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pemeriksaan;

/**
 * @property Pemeriksaan $resource
 */
class PemeriksaanTransformer extends JsonResource
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
