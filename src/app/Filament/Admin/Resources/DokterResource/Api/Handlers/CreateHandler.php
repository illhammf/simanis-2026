<?php
namespace App\Filament\Admin\Resources\DokterResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\DokterResource;
use App\Filament\Admin\Resources\DokterResource\Api\Requests\CreateDokterRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = DokterResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Dokter
     *
     * @param CreateDokterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateDokterRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}