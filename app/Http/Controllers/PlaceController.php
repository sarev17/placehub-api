<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacesRequest;
use App\Http\Services\API\ApiResponseService;
use App\Models\Place;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="PlaceHub API",
 *     version="1.0.0"
 * )
 */
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/places",
     *     summary="Create a new place",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "city", "state"},
     *             @OA\Property(property="name", type="string", example="Restaurant Bom Sabor"),
     *             @OA\Property(property="city", type="string", example="Rio de Janeiro"),
     *             @OA\Property(property="state", type="string", example="RJ")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Place created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="created!"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Place Name"),
     *                 @OA\Property(property="slug", type="string", example="place-name-1625567890"),
     *                 @OA\Property(property="city", type="string", example="City Name"),
     *                 @OA\Property(property="state", type="string", example="ST")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to create place",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Failed to create place"),
     *             @OA\Property(property="errors", type="array", @OA\Items())
     *         )
     *     )
     * )
     */
    public function store(PlacesRequest $request): JsonResponse
    {
        try {
            $place = Place::create($request->all());
            return ApiResponseService::success('created!', $place->only('id', 'name', 'slug', 'city', 'state'), 201);
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to create place', [], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/places/{id}",
     *     summary="Get a specific place",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Place found"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Place not found"
     *     )
     * )
     */

    public function show(string $id)
    {
        $place = Place::find($id);

        if (!$place) {
            return ApiResponseService::error('Place not found', [], 404);
        }
        return ApiResponseService::success('Place ' . $id, $place, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * @OA\Put(
     *     path="/places/{id}",
     *     summary="Update a specific place",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "city", "state"},
     *             @OA\Property(property="name", type="string", example="Place Name"),
     *             @OA\Property(property="city", type="string", example="City Name"),
     *             @OA\Property(property="state", type="string", example="ST")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Place updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Place not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to update place"
     *     )
     * )
     */

    public function update(PlacesRequest $request, string $id): JsonResponse
    {
        try {
            $place = Place::find($id);
            if (!$place) {
                return ApiResponseService::error('Place not found', [], 404);
            }
            $place->update($request->all());

            return ApiResponseService::success($place, 'Place updated successfully.', 200);
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to update place.' . [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/places/search/{name}",
     *     summary="Search places by name",
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Found places"
     *     )
     * )
     */

    public function search($name)
    {
        $places = Place::where('name', 'like', "%$name%")->get();
        return ApiResponseService::success('Found ' . count($places) . ' registers', $places);
    }
}
