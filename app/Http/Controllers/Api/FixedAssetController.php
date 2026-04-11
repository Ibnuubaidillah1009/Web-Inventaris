<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFixedAssetRequest;
use App\Http\Requests\UpdateFixedAssetRequest;
use App\Http\Resources\FixedAssetResource;
use App\Models\FixedAsset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FixedAssetController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $assets = FixedAsset::with('location')
            ->filter(request()->only(['search', 'condition_status', 'is_active', 'location_id']))
            ->latest()
            ->paginate(15);

        return FixedAssetResource::collection($assets);
    }

    public function store(StoreFixedAssetRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['asset_code'] = $this->generateAssetCode();

        $asset = FixedAsset::create($data);
        $asset->load('location');

        return response()->json([
            'status'  => true,
            'message' => 'Aset tetap berhasil ditambahkan.',
            'data'    => new FixedAssetResource($asset),
        ], 201);
    }

    public function show(FixedAsset $fixedAsset): JsonResponse
    {
        $fixedAsset->load('location', 'mutations.fromLocation', 'mutations.toLocation');

        return response()->json([
            'status'  => true,
            'message' => 'Detail aset tetap.',
            'data'    => new FixedAssetResource($fixedAsset),
        ]);
    }

    public function update(UpdateFixedAssetRequest $request, FixedAsset $fixedAsset): JsonResponse
    {
        $fixedAsset->update($request->validated());
        $fixedAsset->load('location');

        return response()->json([
            'status'  => true,
            'message' => 'Aset tetap berhasil diperbarui.',
            'data'    => new FixedAssetResource($fixedAsset),
        ]);
    }

    public function destroy(FixedAsset $fixedAsset): JsonResponse
    {
        $fixedAsset->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Aset tetap berhasil dihapus.',
            'data'    => null,
        ]);
    }

    /**
     * Generate asset_code format: INV-YYYYMM-XXXX
     * Contoh: INV-202604-0001
     */
    private function generateAssetCode(): string
    {
        $prefix = 'INV-' . now()->format('Ym') . '-';

        // Ambil kode terakhir di bulan yang sama
        $last = FixedAsset::where('asset_code', 'like', $prefix . '%')
            ->orderBy('asset_code', 'desc')
            ->value('asset_code');

        $nextNumber = $last
            ? (int) substr($last, -4) + 1
            : 1;

        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
