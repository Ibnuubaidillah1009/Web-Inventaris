<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function index(): JsonResponse
    {
        $locations = Location::all();

        return response()->json([
            'status'  => true,
            'message' => 'Daftar lokasi.',
            'data'    => LocationResource::collection($locations),
        ]);
    }

    public function store(StoreLocationRequest $request): JsonResponse
    {
        $location = Location::create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Lokasi berhasil ditambahkan.',
            'data'    => new LocationResource($location),
        ], 201);
    }

    public function show(Location $location): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => 'Detail lokasi.',
            'data'    => new LocationResource($location),
        ]);
    }

    public function update(UpdateLocationRequest $request, Location $location): JsonResponse
    {
        $location->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Lokasi berhasil diperbarui.',
            'data'    => new LocationResource($location),
        ]);
    }

    public function destroy(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Lokasi berhasil dihapus.',
            'data'    => null,
        ]);
    }
}
