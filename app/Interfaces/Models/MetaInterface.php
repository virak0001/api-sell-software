<?php

namespace App\Interfaces\Models;

/**
 * @OA\Schema(
 *     schema="Meta",
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         description="Meta information of response.",
 *         @OA\Property (property="include", type="array", @OA\Items(type="string")),
 *         @OA\Property (
 *              property="pagination",
 *              type="object",
 *              allOf={
 *                  @OA\Schema(ref="#/components/schemas/Pagination")
 *              },
 *         )
 *       )
 *     )
 * )
 */
interface MetaInterface
{
    // Meta response
}
