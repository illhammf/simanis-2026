<?php
namespace App\Filament\Admin\Resources\PasienResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PasienResource;
use App\Filament\Admin\Resources\PasienResource\Api\Requests\CreatePasienRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PasienResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pasien
     *
     * @param CreatePasienRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePasienRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}