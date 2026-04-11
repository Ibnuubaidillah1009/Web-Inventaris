<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsumableInboundRequest;
use App\Http\Resources\ConsumableInboundResource;
use App\Models\ConsumableInbound;
use Illuminate\Http\JsonResponse;

class ConsumableInboundController extends Controller
{
    public function index(): JsonResponse
    {
        $inbounds = ConsumableInbound::with(['consumable', 'supplier', 'user'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status'  => true,
            'message' => 'Daftar barang masuk.',
            'data'    => ConsumableInboundResource::collection($inbounds),
        ]);
    }

    public function store(StoreConsumableInboundRequest $request): JsonResponse
    {
        $data             = $request->validated();
        $data['user_id']  = auth()->id();

        // Observer ConsumableInboundObserver::created() akan otomatis increment current_stock.
        $inbound = ConsumableInbound::create($data);
        $inbound->load(['consumable', 'supplier', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Barang masuk berhasil dicatat. Stok telah diperbarui.',
            'data'    => new ConsumableInboundResource($inbound),
        ], 201);
    }

    public function show(ConsumableInbound $consumableInbound): JsonResponse
    {
        $consumableInbound->load(['consumable', 'supplier', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Detail barang masuk.',
            'data'    => new ConsumableInboundResource($consumableInbound),
        ]);
    }

    public function destroy(ConsumableInbound $consumableInbound): JsonResponse
    {
        // Observer ::deleted() akan otomatis rollback stok.
        $consumableInbound->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Catatan barang masuk dihapus. Stok telah di-rollback.',
            'data'    => null,
        ]);
    }
}
