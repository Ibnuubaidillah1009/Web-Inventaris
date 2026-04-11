<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetMutationRequest;
use App\Http\Resources\AssetMutationResource;
use App\Models\AssetMutation;
use Illuminate\Http\JsonResponse;

class AssetMutationController extends Controller
{
    public function index(): JsonResponse
    {
        $mutations = AssetMutation::with(['fixedAsset', 'fromLocation', 'toLocation', 'user'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status'  => true,
            'message' => 'Daftar mutasi aset.',
            'data'    => AssetMutationResource::collection($mutations),
        ]);
    }

    public function store(StoreAssetMutationRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();

        $mutation = AssetMutation::create($data);

        // Perbarui lokasi aset tetap setelah mutasi.
        $mutation->fixedAsset()->update(['location_id' => $data['to_location_id']]);

        $mutation->load(['fixedAsset', 'fromLocation', 'toLocation', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Mutasi aset berhasil dicatat. Lokasi aset telah diperbarui.',
            'data'    => new AssetMutationResource($mutation),
        ], 201);
    }

    public function show(AssetMutation $assetMutation): JsonResponse
    {
        $assetMutation->load(['fixedAsset', 'fromLocation', 'toLocation', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Detail mutasi aset.',
            'data'    => new AssetMutationResource($assetMutation),
        ]);
    }
}
