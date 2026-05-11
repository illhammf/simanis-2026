<?php
namespace App\Filament\Admin\Resources\PelangganResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PelangganResource;
use App\Filament\Admin\Resources\PelangganResource\Api\Requests\CreatePelangganRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PelangganResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pelanggan
     *
     * @param CreatePelangganRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePelangganRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}