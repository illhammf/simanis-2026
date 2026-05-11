<?php
namespace App\Filament\Admin\Resources\PemeriksaanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PemeriksaanResource;
use App\Filament\Admin\Resources\PemeriksaanResource\Api\Requests\CreatePemeriksaanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PemeriksaanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Pemeriksaan
     *
     * @param CreatePemeriksaanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePemeriksaanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}