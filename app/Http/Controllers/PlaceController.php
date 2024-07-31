<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacesRequest;
use App\Http\Services\API\ApiResponseService;
use App\Models\Place;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function store(PlacesRequest $request): JsonResponse
    {
        try {
            $place = Place::create($request->all());
            return ApiResponseService::success('created!', $place->only('id','name','slug','city','state'), 201);
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to create place', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlacesRequest $request, string $id): JsonResponse
    {
        try {
            $place = Place::findOrFail($id);
            $place->update($request->all());
            $data = $place->only(['id','name', 'slug', 'city', 'state']);

            return ApiResponseService::success($data, 'Place updated successfully.', 200);
        } catch (Exception $e) {
            return ApiResponseService::error('Failed to update place. ' . $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
