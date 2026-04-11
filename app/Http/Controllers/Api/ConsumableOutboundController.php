<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsumableOutboundRequest;
use App\Http\Resources\ConsumableOutboundResource;
use App\Models\ConsumableOutbound;
use Illuminate\Http\JsonResponse;

class ConsumableOutboundController extends Controller
{
    public function index(): JsonResponse
    {
        $outbounds = ConsumableOutbound::with(['consumable', 'user'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status'  => true,
            'message' => 'Daftar barang keluar.',
            'data'    => ConsumableOutboundResource::collection($outbounds),
        ]);
    }

    public function store(StoreConsumableOutboundRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();

        // Observer ConsumableOutboundObserver::creating() validasi stok cukup.
        // Observer ConsumableOutboundObserver::created() decrement current_stock.
        $outbound = ConsumableOutbound::create($data);
        $outbound->load(['consumable', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Barang keluar berhasil dicatat. Stok telah dikurangi.',
            'data'    => new ConsumableOutboundResource($outbound),
        ], 201);
    }

    public function show(ConsumableOutbound $consumableOutbound): JsonResponse
    {
        $consumableOutbound->load(['consumable', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Detail barang keluar.',
            'data'    => new ConsumableOutboundResource($consumableOutbound),
        ]);
    }

    public function destroy(ConsumableOutbound $consumableOutbound): JsonResponse
    {
        // Observer ::deleted() akan otomatis kembalikan stok.
        $consumableOutbound->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Catatan barang keluar dihapus. Stok telah dikembalikan.',
            'data'    => null,
        ]);
    }
}
