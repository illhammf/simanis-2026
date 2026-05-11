<?php
namespace App\Filament\Admin\Resources\PasienResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Pasien;

/**
 * @property Pasien $resource
 */
class PasienTransformer extends JsonResource
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
