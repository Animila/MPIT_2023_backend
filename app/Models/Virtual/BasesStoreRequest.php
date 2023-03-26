<?php

namespace App\Models\Virtual;

use OpenApi\Annotations as OA;
// ссылка на модель
/**
 * @OA\Schema(
 *     description="Пример простого запроса для создания базы",
 *     type="object",
 *     title="Пример запроса для создания"
 * )
 */

class BasesStoreRequest {
    /**
     * @OA\Property (
     *     title="Name",
     *     description="Название базы",
     *     format="string",
     *     example="Ааарт"
     * )
     * @var string
     */
    public $title;

    /**
     * @OA\Property (
     *     title="Description",
     *     description="Описание базы",
     *     format="string",
     *     example="Парк для всех семьи"
     * )
     * @var string
     */
    public $description;
    /**
     * @OA\Property (
     *     title="Longitude",
     *     description="Долгота базы",
     *     format="string",
     *     example="129.675476"
     * )
     * @var string
     */
    public $longitude;
    /**
     * @OA\Property (
     *     title="Latitude",
     *     description="Ширина базы",
     *     format="string",
     *     example="62.035454"
     * )
     * @var string
     */
    public $latitude;
}
