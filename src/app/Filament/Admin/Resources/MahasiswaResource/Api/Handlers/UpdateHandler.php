<?php
namespace App\Filament\Admin\Resources\MahasiswaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\MahasiswaResource;
use App\Filament\Admin\Resources\MahasiswaResource\Api\Requests\UpdateMahasiswaRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = MahasiswaResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Mahasiswa
     *
     * @param UpdateMahasiswaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateMahasiswaRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}