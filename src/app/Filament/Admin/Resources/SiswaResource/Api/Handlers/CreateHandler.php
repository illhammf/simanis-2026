<?php
namespace App\Filament\Admin\Resources\SiswaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\SiswaResource;
use App\Filament\Admin\Resources\SiswaResource\Api\Requests\CreateSiswaRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = SiswaResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Siswa
     *
     * @param CreateSiswaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateSiswaRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}