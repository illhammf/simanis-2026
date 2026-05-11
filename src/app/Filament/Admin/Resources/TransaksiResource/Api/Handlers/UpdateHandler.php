<?php
namespace App\Filament\Admin\Resources\TransaksiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\TransaksiResource;
use App\Filament\Admin\Resources\TransaksiResource\Api\Requests\UpdateTransaksiRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = TransaksiResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Transaksi
     *
     * @param UpdateTransaksiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateTransaksiRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}