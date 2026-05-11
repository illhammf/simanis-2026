<?php
namespace App\Filament\Admin\Resources\BukuResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\BukuResource;
use App\Filament\Admin\Resources\BukuResource\Api\Requests\CreateBukuRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BukuResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Buku
     *
     * @param CreateBukuRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateBukuRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}