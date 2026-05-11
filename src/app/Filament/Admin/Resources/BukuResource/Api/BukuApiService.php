<?php
namespace App\Filament\Admin\Resources\BukuResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\BukuResource;
use Illuminate\Routing\Router;


class BukuApiService extends ApiService
{
    protected static string | null $resource = BukuResource::class;

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
