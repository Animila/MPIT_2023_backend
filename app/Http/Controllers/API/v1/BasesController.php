<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasesStoreRequest;
use App\Models\Base;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function response;

class BasesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/bases",
     *     operationId="basesAll",
     *     tags={"Base"},
     *     summary="Получение список всех баз",
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Номер страницы",
     *          required=false,
     *          @OA\Schema(
     *               type="integer",
     *           )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Все прошло хорошо"
     *      )
     * )
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $listBases = Base::query()->with('services.bonuses')->paginate(2);

        return response()->json($listBases);
    }

    /**
     * @OA\Post(
     *     path="/bases",
     *     operationId="basesCreate",
     *     tags={"Base"},
     *     summary="Создание новой базы",
     *     security={
     *     },
     *     @OA\Response(
     *          response="200",
     *          description="Все прошло хорошо",
     *       @OA\JsonContent(type="object")
     *
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="Ошибка создания на стороне сервера",
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *     @OA\JsonContent(ref="#/components/schemas/BasesStoreRequest")
     *      )
     * )
     * Store a newly created resource in storage.
     *
     * @param BasesStoreRequest $request
     * @return JsonResponse
     */
    public function store(BasesStoreRequest $request)
    {
        try {
            $requestValidated =  $request->validated();
            $created = Base::create($requestValidated);
            if($created) {
                return response()->json($created);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => "Ошибка создания базы: $e"], 500);
    }
    }

    /**
     * @OA\Get(
     *     path="/bases/{id}",
     *     operationId="baseId",
     *     tags={"Base"},
     *     summary="Получение базы по id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID базы",
     *          required=true,
     *          @OA\Schema(
     *               type="integer",
     *                  format="int64"
     *           )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Все прошло хорошо"
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Данные не обнаружены"
     *      )
     * )
     * Display the specified resource.
     *
     * @param Base $base
     * @return JsonResponse
     */
    public function show($id)
    {
        $base = Base::with('services.bonuses')->find($id);
        if(!$base) {
            return response()->json('База не найдена', 404);
        }
        return response()->json($base);
    }

    /**
     * @OA\Put(
     *     path="/bases/{id}",
     *     operationId="baseUpdateId",
     *     tags={"Base"},
     *     summary="Обновление базы по id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID базы",
     *          required=true,
     *          @OA\Schema(
     *               type="integer",
     *                  format="int64"
     *           )
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *     @OA\JsonContent(ref="#/components/schemas/BasesUpdateRequest")
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Все прошло хорошо"
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Нет никакого тела запроса"
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="База не найдена"
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="Ошибка обновления на стороне сервера",
     *      ),
     * )
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $base = Base::find($id);
            if(!$base) {
                return response()->json(['error'=>'База не найдена'], 404);
            }
            if(!isset($request['title']) && !isset($request['description']) && !(isset($request['longitude'])) && !(isset($request['latitude']))) {
                return response()->json(['error' => 'Заполните хотя бы одно поле'], 422);
            }
            $base->update($request->all());
            return response()->json($base);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return response()->json(['error' => "Ошибка создания базы: $error"], 500);
    }
    }

    /**
     * @OA\Delete(
     *     path="/bases/{id}",
     *     operationId="baseDeleteId",
     *     tags={"Base"},
     *     summary="Удаление базы по id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID базы",
     *          required=true,
     *          @OA\Schema(
     *               type="integer",
     *                  format="int64"
     *           )
     *      ),
     *     @OA\Response(
     *          response="201",
     *          description="Все прошло хорошо"
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="База не найдена"
     *      )
     * )
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $base = Base::findOrFail($id);
        if(!$base) {
            return response()->json(['error'=>'База не найдена'], 404);
        }
        $base->delete();

        return response()->json('', 201);

    }
}
