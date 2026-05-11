<?php

namespace App\Filament\Admin\Resources\SiswaResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\SiswaResource;
use Illuminate\Routing\Router;


class SiswaApiService extends ApiService
{
    protected static string | null $resource = SiswaResource::class;

    public static function handlers(): array
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
