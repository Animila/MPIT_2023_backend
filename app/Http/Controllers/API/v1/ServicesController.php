<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesStoreRequest;
use App\Models\Base;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/bases/{id}/services",
     *     operationId="servicesBaseAll",
     *     tags={"Service"},
     *     summary="Получение списка всех услуг базы",
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
     * @OA\Response(
     *          response="404",
     *          description="База не найдена"
     *      )
     * )
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index($id)
    {
        $base = Base::find($id);
        if(!$base) {
           return response()->json(['error'=>'База не найдена'], 404);
    }
        return response()->json($base->services()->with('bonuses')->get());
    }

    /**
     * @OA\Post(
     *     path="/services",
     *     operationId="servicesCreate",
     *     tags={"Service"},
     *     summary="Создание новой услуги для базы",
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
     *          description="База не найдена",
     *      ),
     *     @OA\RequestBody(
     *      required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ServicesStoreRequest")
     *      )
     * )
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(ServicesStoreRequest $request)
    {
        try {
            if(!Base::find($request['base_id'])) {
                return response()->json(['error'=>'База не найдена'], 404);
            }
            $validatedBody = $request->validated();
            $newItem = Item::create($validatedBody);
            if(!$newItem) {
                return response()->json(['error'=>'Ошибка создания услуги'], 500);
            }

            return response()->json($newItem);
        }catch (\Exception $error) {
            $msg = $error->getMessage();
            return response()->json(['error'=>"Ошибка сохранения: $msg"], 500);
        }

    }

    /**
     * @OA\Get(
     *     path="/services/{id}",
     *     operationId="servicesId",
     *     tags={"Service"},
     *     summary="Получение услуги по id",
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
        $selectedServices = Item::with('bonuses')->find($id);
        if(!$selectedServices) {
            return response()->json('Услуга не найдена', 404);
        }
        return response()->json($selectedServices);
    }

    /**
     * @OA\Put(
     *     path="/services/{id}",
     *     operationId="servicesUpdateId",
     *     tags={"Service"},
     *     summary="Обновление услуги по id",
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
     *     @OA\RequestBody(
     *      required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ServicesUpdateRequest")
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
     *          description="Услуга не найдена"
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
            $selectedService = Item::find($id);
            if(!$selectedService) {
                return response()->json(['error'=>'Услуга не найдена'], 404);
            }
            if(isset($request['base_id']) && !Base::find($request['base_id'])) {
                return response()->json(['error'=>'База не найдена'], 404);
            }
            if(!isset($request['base_id']) && !isset($request['title']) && !(isset($request['countPeople'])) && !(isset($request['price']))) {
                return response()->json(['error' => 'Заполните хотя бы одно поле'], 422);
            }
            $selectedService->update($request->all());
            return response()->json($selectedService);

        } catch (\Exception $er) {
            $error = $er->getMessage();
            return response()->json(['error'=>"Ошибка обновления услуги: $error"], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/services/{id}",
     *     operationId="serviceDeleteId",
     *     tags={"Service"},
     *     summary="Удаление услуги по id",
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
        $selected = Item::find($id);
        if(!$selected) {
            return response()->json('Услуга не найдена', 404);
        }
        $selected->delete();
        return response()->json('', 201);
    }
}
