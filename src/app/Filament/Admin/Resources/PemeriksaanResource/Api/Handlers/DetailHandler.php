<?php

namespace App\Filament\Admin\Resources\PemeriksaanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Admin\Resources\PemeriksaanResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Admin\Resources\PemeriksaanResource\Api\Transformers\PemeriksaanTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PemeriksaanResource::class;


    /**
     * Show Pemeriksaan
     *
     * @param Request $request
     * @return PemeriksaanTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new PemeriksaanTransformer($query);
    }
}
