<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Measurement;
use App\Models\NutritionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    public function store(Request $request, Children $child)
    {
        if ($child->parent_id !== Auth::id()) abort(403);

        $measurement = Measurement::create([
            'child_id' => $child->id,
            'measured_at' => now(),
            'weight_kg' => $request->weight_kg,
            'height_cm' => $request->height_cm,
            'muac_cm' => $request->muac_cm,
        ]);

        // kalkulasi ngasal
        $status = $measurement->weight_kg < 10 ? 'gizi kurang' : 'normal';

        NutritionStatus::create([
            'measurement_id' => $measurement->id,
            'bb_u_status' => $status,
        ]);

        return back()->with('success', 'Pengukuran berhasil disimpan.');
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return back()->with('success', 'Pengukuran berhasil dihapus.');
    }
}
