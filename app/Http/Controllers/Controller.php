<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API TourTravel documentation",
 *     version="1.0.0",
 *     termsOfService="http://swagger.io/terms/",
 *     description="Система API для работы с приложением TourTravel",
 *     @OA\Contact(
 *          email="khristoforov-i@mail.ru"
 * ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Base",
 *     description="Работа с данными о базах",
 * )
 * @OA\Server(
 *     description="Сервер API для запросов v1",
 *     url="http://127.0.0.1:8000/api/v1"
 * )
 *  * @OA\Server(
 *     description="Сервер API для запросов v2",
 *     url="http://127.0.0.1:8000/api/v2"
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth",
 *     name="token"
 * )
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
