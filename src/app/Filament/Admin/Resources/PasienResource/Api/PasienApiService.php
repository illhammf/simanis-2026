<?php
namespace App\Filament\Admin\Resources\PasienResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\PasienResource;
use Illuminate\Routing\Router;


class PasienApiService extends ApiService
{
    protected static string | null $resource = PasienResource::class;

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
