<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\ReturnBorrowingRequest;
use App\Http\Resources\BorrowingResource;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BorrowingController extends Controller
{
    public function index(): JsonResponse
    {
        $borrowings = Borrowing::with(['user', 'details.fixedAsset'])
            ->when(request('status'), fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15);

        return response()->json([
            'status'  => true,
            'message' => 'Daftar peminjaman.',
            'data'    => BorrowingResource::collection($borrowings),
        ]);
    }

    public function store(StoreBorrowingRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $borrowing = Borrowing::create([
                'borrow_code'          => $this->generateBorrowCode(),
                'borrower_name'        => $validated['borrower_name'],
                'borrow_date'          => $validated['borrow_date'],
                'expected_return_date' => $validated['expected_return_date'],
                'status'               => 'dipinjam',
                'user_id'              => auth()->id(),
            ]);

            foreach ($validated['details'] as $detail) {
                $borrowing->details()->create([
                    'fixed_asset_id'         => $detail['fixed_asset_id'],
                    'condition_when_borrowed' => $detail['condition_when_borrowed'] ?? 'baik',
                ]);
            }

            $borrowing->load(['user', 'details.fixedAsset']);

            return response()->json([
                'status'  => true,
                'message' => 'Peminjaman berhasil dibuat.',
                'data'    => new BorrowingResource($borrowing),
            ], 201);
        });
    }

    public function show(Borrowing $borrowing): JsonResponse
    {
        $borrowing->load(['user', 'details.fixedAsset']);

        return response()->json([
            'status'  => true,
            'message' => 'Detail peminjaman.',
            'data'    => new BorrowingResource($borrowing),
        ]);
    }

    /**
     * Proses pengembalian: update kondisi per item + ubah status borrowing.
     */
    public function returnAsset(ReturnBorrowingRequest $request, Borrowing $borrowing): JsonResponse
    {
        if ($borrowing->status === 'dikembalikan') {
            return response()->json([
                'status'  => false,
                'message' => 'Peminjaman ini sudah dikembalikan sebelumnya.',
                'data'    => null,
            ], 422);
        }

        return DB::transaction(function () use ($request, $borrowing) {
            $validated = $request->validated();

            $borrowing->update([
                'actual_return_date' => $validated['actual_return_date'],
                'status'             => 'dikembalikan',
            ]);

            $borrowing->load(['user', 'details.fixedAsset']);

            return response()->json([
                'status'  => true,
                'message' => 'Aset berhasil dikembalikan.',
                'data'    => new BorrowingResource($borrowing),
            ]);
        });
    }

    private function generateBorrowCode(): string
    {
        return 'BRW-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
    }
}
