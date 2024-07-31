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
            return ApiResponseService::error('Failed to create place', [] ,500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::find($id);

        if(!$place){
            return ApiResponseService::error('Place not found',[],404);
        }
        return ApiResponseService::success('Place '.$id,$place,200);
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
            $place = Place::find($id);
            if(!$place){
                return ApiResponseService::error('Place not found', [],404);
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
     * filter places
     */

     public function search($name){
        $places = Place::where('name','like',"%$name%")->get();
        return ApiResponseService::success('Found '.count($places). ' registers',$places);
     }
}
