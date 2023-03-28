<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BonusesStoreRequest;
use App\Http\Requests\ServicesStoreRequest;
use App\Models\Base;
use App\Models\Bonus;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BonusesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/services/{id}/bonuses",
     *     operationId="bonusesServicesAll",
     *     tags={"Bonus"},
     *     summary="Получение списка всех бонусов у услуги",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID услуги",
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
     * @OA\Response(
     *          response="404",
     *          description="Услуга не найдена"
     *      )
     * )
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index($id)
    {
        $services = Item::find($id);
        if(!$services) {
            return response()->json(['error'=>'Услуга не найдена'], 404);
        }
        return response()->json($services->bonuses()->with('bonuses')->get());
    }

    /**
     * @OA\Post(
     *     path="/bonuses",
     *     operationId="bonusesCreate",
     *     tags={"Bonus"},
     *     summary="Создание нового бонуса для услуги",
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
     *     @OA\Response(
     *          response="404",
     *          description="Услуга не найдена",
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *     @OA\JsonContent(ref="#/components/schemas/BonusesStoreRequest")
     *      )
     * )
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(BonusesStoreRequest $request)
    {
        try {
            if(!Item::find($request['item_id'])) {
                return response()->json(['error'=>'Услуга не найдена'], 404);
            }
            $validatedBody = $request->validated();
            $newBonus = Bonus::create($validatedBody);
            if(!$newBonus) {
                return response()->json(['error'=>'Ошибка создания бонуса'], 500);
            }

            return response()->json($newBonus);
        }catch (\Exception $error) {
            $msg = $error->getMessage();
            return response()->json(['error'=>"Ошибка сохранения: $msg"], 500);
        }

    }

    /**
     * @OA\Get(
     *     path="/bonuses/{id}",
     *     operationId="bonusesId",
     *     tags={"Bonus"},
     *     summary="Получение бонуса по id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID бонуса",
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
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $selectedBonus = Bonus::find($id);
        if(!$selectedBonus) {
            return response()->json('Бонус не найден', 404);
        }
        return response()->json($selectedBonus);
    }

    /**
     * @OA\Put(
     *     path="/bonuses/{id}",
     *     operationId="bonusesUpdateId",
     *     tags={"Bonus"},
     *     summary="Обновление бонуса по id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID бонуса",
     *          required=true,
     *          @OA\Schema(
     *               type="integer",
     *                  format="int64"
     *           )
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *     @OA\JsonContent(ref="#/components/schemas/BonusesUpdateRequest")
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
     *          description="Бонус не найден"
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="Ошибка обновления на стороне сервера",
     *      )
     * )
     * Update the specified resource in storage..
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $selectedBonus = Bonus::find($id);
            if(!$selectedBonus) {
                return response()->json(['error'=>'Бонус не найден'], 404);
            }
            if(isset($request['item_id']) && !Item::find($request['item_id'])) {
                return response()->json(['error'=>'Услуга не найдена'], 404);
            }
            if(!isset($request['item_id']) && !isset($request['count']) && !(isset($request['type']))) {
                return response()->json(['error' => 'Заполните хотя бы одно поле'], 422);
            }
            $selectedBonus->update($request->all());
            return response()->json($selectedBonus);

        } catch (\Exception $er) {
            $error = $er->getMessage();
            return response()->json(['error'=>"Ошибка обновления бонуса: $error"], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/bonuses/{id}",
     *     operationId="bonusesDeleteId",
     *     tags={"Bonus"},
     *     summary="Удаление бонуса по id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID бонуса",
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
        $selected = Bonus::find($id);
        if(!$selected) {
            return response()->json('Бонус не найден', 404);
        }
        $selected->delete();
        return response()->json('', 201);
    }
}
