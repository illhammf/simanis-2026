<?php
namespace App\Filament\Admin\Resources\TransaksiResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Transaksi;

/**
 * @property Transaksi $resource
 */
class TransaksiTransformer extends JsonResource
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
