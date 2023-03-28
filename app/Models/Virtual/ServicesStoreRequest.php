<?php

namespace App\Models\Virtual;

use OpenApi\Annotations as OA;
// ссылка на модель
/**
 * @OA\Schema(
 *     description="Пример простого запроса для услуги для базы",
 *     type="object",
 *     title="Пример запроса для создания"
 * )
 */

class ServicesStoreRequest {
    /**
     * @OA\Property (
     *     title="Title",
     *     description="Название услуги",
     *     format="string",
     *     example="Ночека в двухэтажном доме"
     * )
     * @var string
     */
    public $title;

    /**
     * @OA\Property (
     *     title="CountPeople",
     *     description="Количество доступных мест",
     *     format="int32",
     *     example="2"
     * )
     * @var int
     */
    public $countPeople;

    /**
     * @OA\Property (
     *     title="Price",
     *     description="Количество доступных мест",
     *     format="float",
     *     example="3456.23"
     * )
     * @var float
     */
    public $price;

    /**
     * @OA\Property (
     *     title="BaseId",
     *     description="Идентификатор базы",
     *     format="int64",
     *     example="2"
     * )
     * @var int
     */
    public $base_id;

}
