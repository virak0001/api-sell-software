<?php

namespace App\Interfaces\Models;

/**
 * @OA\Schema(
 *     schema="Pagination",
 *     @OA\Property(
 *         property="total",
 *         type="integer",
 *         format="int32"
 *     ),
 *     @OA\Property(
 *         property="count",
 *         type="integer",
 *         format="int32"
 *     ),
 *     @OA\Property(
 *         property="per_page",
 *         type="integer",
 *         format="int32"
 *     ),
 *     @OA\Property(
 *         property="current_page",
 *         type="integer",
 *         format="int32"
 *     ),
 *     @OA\Property(
 *         property="total_pages",
 *         type="integer",
 *         format="int32"
 *     )
 * )
 */
interface PaginationInterface
{
}
