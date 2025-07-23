<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\surveys;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'kualitas_produk' => 'required|integer|between:1,5',
            'pelayanan' => 'required|integer|between:1,5',
            'pengiriman' => 'required|integer|between:1,5',
            'kemudahan_transaksi' => 'required|integer|between:1,5',
            'harga_nilai' => 'required|integer|between:1,5',
            'after_sales' => 'required|integer|between:1,5',
            'kepuasan_umum' => 'required|integer|between:1,5',
            'nps' => 'required|integer|between:0,10',
            'saran' => 'nullable|string'
        ]);

        surveys::create($validated);
        return response()->json(['message' => 'Survei berhasil dikirim!'], 201);
    }



    public function summary(Request $request)
    {
        $start = $request->query('start');
        $end   = $request->query('end');

        $q = surveys::query();
        if ($start) {
            $q->whereDate('created_at', '>=', $start);
        }
        if ($end) {
            $q->whereDate('created_at', '<=', $end);
        }

        $count = $q->count();
        $avg   = $count ? round($q->avg('kepuasan_umum'), 2) : 0;

        $responses = $q
            ->orderBy('created_at', 'desc')
            ->get([
                'id',
                'nama',
                'kualitas_produk',
                'pelayanan',
                'pengiriman',
                'kemudahan_transaksi',
                'harga_nilai',
                'after_sales',
                'kepuasan_umum',
                'nps',
                'saran',
                'created_at',
            ]);

        return response()->json([
            'csat'      => $avg,
            'count'     => $count,
            'responses' => $responses,
        ]);
    }

    public function update(Request $request, surveys $survey)
    {

        $validated = $request->validate([
            'nama' => 'sometimes|string|max:100',
            'kualitas_produk' => 'sometimes|integer|between:1,5',
            'pelayanan' => 'sometimes|integer|between:1,5',
            'pengiriman' => 'sometimes|integer|between:1,5',
            'kemudahan_transaksi' => 'sometimes|integer|between:1,5',
            'harga_nilai' => 'sometimes|integer|between:1,5',
            'after_sales' => 'sometimes|integer|between:1,5',
            'kepuasan_umum' => 'sometimes|integer|between:1,5',
            'nps' => 'sometimes|integer|between:0,10',
            'saran' => 'sometimes|string|nullable',
        ]);

        $survey->update($validated);
        return response()->json(['message' => 'Survey berhasil diperbarui', 'survey' => $survey]);
    }

    public function destroy(surveys $survey)
    {
        $survey->delete();
        return response()->json(['message' => 'Survey berhasil dihapus']);
    }


    public function index()
    {
        return surveys::latest()->get();
    }
}

