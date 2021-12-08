<?php

namespace App\Interfaces\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Interface ProductControllerInterface.
 *
 * @package namespace App\Repositories;
 */
interface ProductControllerInterface
{
    /**
     * @OA\Get(path="/products?page={page}&limit={limit}&orderBy={orderBy}&sortedBy={sortedBy}&include={include}&search={search}&searchJoin={searchJoin}",
     *   tags={"Product"},
     *   summary="Get uom list information",
     *   description="Fetch product data.",
     *   operationId="get-uom",
     *   @OA\Parameter(
     *     name="page",
     *     in="path",
     *     description="Page number",
     *     required=false,
     *     @OA\Schema(
     *         type="integer",
     *         format="int32",
     *         minimum=1.0,
     *         default=1
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="limit",
     *     in="path",
     *     description="Page limit",
     *     required=false,
     *     @OA\Schema(
     *         type="integer",
     *         format="int32",
     *         minimum=1.0,
     *         default=20
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="orderBy",
     *     in="path",
     *     description="Order by",
     *     required=false,
     *     @OA\Schema(
     *         type="string",
     *         default="created_at"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="sortedBy",
     *     in="path",
     *     description="Sorted by",
     *     required=false,
     *     @OA\Schema(
     *         type="string",
     *         default="asc"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="include",
     *     in="path",
     *     description="The relationship that need to be fetch",
     *     required=false,
     *     @OA\Schema(
     *         type="array",
     *         default="",
     *         @OA\Items(
     *             type="string"
     *         )
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="search",
     *     in="path",
     *     description="Search with keyword",
     *     required=false,
     *     allowEmptyValue=true,
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="searchJoin",
     *     in="path",
     *     description="Search Join",
     *     required=false,
     *     @OA\Schema(
     *         type="string",
     *         default="or"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Product response.",
     *     @OA\JsonContent(
     *      @OA\Property(
     *         property="data",
     *         type="array",
     *         description="The list of all product",
     *         @OA\Items(
     *            type="object",
     *            allOf={
     *              @OA\Schema(ref="#/components/schemas/Product")
     *            },
     *         )
     *       ),
     *       allOf={
     *          @OA\Schema(ref="#/components/schemas/Meta")
     *       },
     *     )
     *   ),
     *   @OA\Response(response=400, description="You are not logged in."),
     *   @OA\Response(response=404, description="Product not found")
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse;
    public function store(Request $request): JsonResponse;
    public function update(Request $request, $id): JsonResponse;
    public function show($id): JsonResponse;
    public function destroy($id): JsonResponse;
}
