<?php
namespace App\Filament\Admin\Resources\PeminjamanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\PeminjamanResource;
use Illuminate\Routing\Router;


class PeminjamanApiService extends ApiService
{
    protected static string | null $resource = PeminjamanResource::class;

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
