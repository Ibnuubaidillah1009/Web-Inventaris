<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStockOpnameRequest;
use App\Http\Resources\StockOpnameResource;
use App\Models\StockOpname;
use Illuminate\Http\JsonResponse;

class StockOpnameController extends Controller
{
    public function index(): JsonResponse
    {
        $opnames = StockOpname::with(['opnable', 'user'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'status'  => true,
            'message' => 'Daftar stock opname.',
            'data'    => StockOpnameResource::collection($opnames),
        ]);
    }

    public function store(StoreStockOpnameRequest $request): JsonResponse
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();

        $opname = StockOpname::create($data);

        // Update kondisi aset berdasarkan hasil opname.
        $opname->opnable()->update(['condition_status' => $data['actual_condition']]);

        $opname->load(['opnable', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Stock opname berhasil dicatat. Kondisi aset diperbarui.',
            'data'    => new StockOpnameResource($opname),
        ], 201);
    }

    public function show(StockOpname $stockOpname): JsonResponse
    {
        $stockOpname->load(['opnable', 'user']);

        return response()->json([
            'status'  => true,
            'message' => 'Detail stock opname.',
            'data'    => new StockOpnameResource($stockOpname),
        ]);
    }
}
