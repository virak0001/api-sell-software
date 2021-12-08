<?php


namespace App\Interfaces\Models;

/**
 * @OA\Schema (
 *     schema="Product",
 *     @OA\Property(
 *         property="id",
 *         type="string",
 *         description="ID, It will generate when model has been created"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Product name"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Product description"
 *     ),
 *     @OA\Property(
 *         property="reorder_level",
 *         type="string",
 *         description="Product reorder_level"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="int",
 *         description="Product price"
 *     ),
 *     @OA\Property(
 *         property="year",
 *         type="string",
 *         description="Product year"
 *     ),
 *     @OA\Property(
 *         property="model",
 *         type="string",
 *         description="Product model"
 *     ),
 * )
 */


interface ProductInterface
{

}
