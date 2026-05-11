<?php
namespace App\Filament\Admin\Resources\PeminjamanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PeminjamanResource;
use App\Filament\Admin\Resources\PeminjamanResource\Api\Requests\UpdatePeminjamanRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PeminjamanResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Peminjaman
     *
     * @param UpdatePeminjamanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePeminjamanRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}