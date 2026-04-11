<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsumableRequest;
use App\Http\Requests\UpdateConsumableRequest;
use App\Http\Resources\ConsumableResource;
use App\Models\Consumable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConsumableController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $query = Consumable::query();

        if (request()->boolean('low_stock')) {
            $query->whereColumn('current_stock', '<=', 'min_stock');
        }

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%");
            });
        }

        return ConsumableResource::collection($query->latest()->paginate(15));
    }

    public function store(StoreConsumableRequest $request): JsonResponse
    {
        $consumable = Consumable::create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Barang habis pakai berhasil ditambahkan.',
            'data'    => new ConsumableResource($consumable),
        ], 201);
    }

    public function show(Consumable $consumable): JsonResponse
    {
        $consumable->load('inbounds.supplier', 'outbounds');

        return response()->json([
            'status'  => true,
            'message' => 'Detail barang habis pakai.',
            'data'    => new ConsumableResource($consumable),
        ]);
    }

    public function update(UpdateConsumableRequest $request, Consumable $consumable): JsonResponse
    {
        $consumable->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Barang habis pakai berhasil diperbarui.',
            'data'    => new ConsumableResource($consumable),
        ]);
    }

    public function destroy(Consumable $consumable): JsonResponse
    {
        $consumable->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Barang habis pakai berhasil dihapus.',
            'data'    => null,
        ]);
    }
}
