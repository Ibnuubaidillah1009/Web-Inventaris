<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetDisposalRequest;
use App\Http\Resources\AssetDisposalResource;
use App\Models\AssetDisposal;
use Illuminate\Http\JsonResponse;

class AssetDisposalController extends Controller
{
    public function index(): JsonResponse
    {
        $disposals = AssetDisposal::with(['disposable', 'user'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status'  => true,
            'message' => 'Daftar disposal aset.',
            'data'    => AssetDisposalResource::collection($disposals),
        ]);
    }

    public function store(StoreAssetDisposalRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();

        $disposal = AssetDisposal::create($data);

        // Non-aktifkan aset yang di-disposal.
        $disposal->disposable()->update(['is_active' => false]);

        $disposal->load(['disposable', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Disposal aset berhasil dicatat. Aset telah dinonaktifkan.',
            'data'    => new AssetDisposalResource($disposal),
        ], 201);
    }

    public function show(AssetDisposal $assetDisposal): JsonResponse
    {
        $assetDisposal->load(['disposable', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Detail disposal aset.',
            'data'    => new AssetDisposalResource($assetDisposal),
        ]);
    }
}
