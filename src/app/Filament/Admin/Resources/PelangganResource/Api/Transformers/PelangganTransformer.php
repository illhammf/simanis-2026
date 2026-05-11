<?php
namespace App\Filament\Admin\Resources\PelangganResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pelanggan;

/**
 * @property Pelanggan $resource
 */
class PelangganTransformer extends JsonResource
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
