<?php
namespace App\Filament\Admin\Resources\PeminjamanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PeminjamanResource;
use App\Filament\Admin\Resources\PeminjamanResource\Api\Requests\CreatePeminjamanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PeminjamanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Peminjaman
     *
     * @param CreatePeminjamanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePeminjamanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}