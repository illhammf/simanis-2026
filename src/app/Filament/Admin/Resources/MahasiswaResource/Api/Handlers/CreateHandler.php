<?php
namespace App\Filament\Admin\Resources\MahasiswaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\MahasiswaResource;
use App\Filament\Admin\Resources\MahasiswaResource\Api\Requests\CreateMahasiswaRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = MahasiswaResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Mahasiswa
     *
     * @param CreateMahasiswaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateMahasiswaRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}