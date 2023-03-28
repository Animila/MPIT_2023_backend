<?php

namespace App\Models\Virtual;

/**
 * @OA\Schema(
 *     description="Пример простого запроса обноеления бонуса для услуги",
 *     type="object",
 *     title="Пример запроса для обноеления"
 * )
 */

class BonusesUpdateRequest {

    /**
     * @OA\Property (
     *     title="ItemId",
     *     description="Идентификатор услуги",
     *     format="int64",
     *     example="2"
     * )
     * @var int
     */
    public $item_id;

    /**
     * @OA\Property (
     *     title="Type",
     *     description="Тип услуги (0 - для постоянных, 1 - при 'нарнии')",
     *     format="int32",
     *     example="0"
     * )
     * @var int
     */
    public $type;

    /**
     * @OA\Property (
     *     title="Count",
     *     description="Количество получаемых бонусов",
     *     format="int64",
     *     example="1234"
     * )
     * @var int
     */
    public $count;



}
