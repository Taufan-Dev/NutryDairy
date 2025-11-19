<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Measurement;
use App\Models\NutritionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'measured_at' => 'required|date',
            'weight_kg' => 'required|numeric',
            'height_cm' => 'required|numeric',
        ]);

        $child = Children::where('parent_id', Auth::id())
            ->where('name', $request->input('name'))
            ->where('birth_date', $request->input('birth_date'))
            ->where('gender', $request->input('gender'))
            ->first();

        if (!$child) {
            $child = new Children();
            $child->parent_id = Auth::id();
            $child->name = $request->input('name');
            $child->birth_date = $request->input('birth_date');
            $child->gender = $request->input('gender');
            $child->save();
        }

        $measurement = new Measurement();
        $measurement->child_id = $child->id;
        $measurement->measured_at = $request->input('measured_at');
        $measurement->weight_kg = $request->input('weight_kg');
        $measurement->height_cm = $request->input('height_cm');
        $measurement->save();

        return back()->with('success', 'Pengukuran berhasil disimpan.');
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return back()->with('success', 'Pengukuran berhasil dihapus.');
    }
}
