<?php
namespace App\Filament\Admin\Resources\PemeriksaanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\PemeriksaanResource;
use Illuminate\Routing\Router;


class PemeriksaanApiService extends ApiService
{
    protected static string | null $resource = PemeriksaanResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
