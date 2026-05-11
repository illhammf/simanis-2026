<?php
namespace App\Filament\Admin\Resources\BukuResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Buku;

/**
 * @property Buku $resource
 */
class BukuTransformer extends JsonResource
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
