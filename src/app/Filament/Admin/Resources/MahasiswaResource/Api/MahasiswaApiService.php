<?php
namespace App\Filament\Admin\Resources\MahasiswaResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\MahasiswaResource;
use Illuminate\Routing\Router;


class MahasiswaApiService extends ApiService
{
    protected static string | null $resource = MahasiswaResource::class;

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
