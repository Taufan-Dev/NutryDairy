<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Measurement;
use App\Models\NutritionStatus;
use App\Models\WhoStandard;
use Carbon\Carbon;
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

        $tanggalLahir = Carbon::parse($child->birth_date);
        $tanggalUkur = Carbon::parse($request->input('measured_at'));

        $ageInDays = $tanggalLahir->diffInDays($tanggalUkur);

        $standard = WhoStandard::getStandard($ageInDays, $request->gender);

        $zScoreTbU = $standard->calculateZScoreTbU($request->height_cm);
        $zScoreBbU = $standard->calculateZScoreBbU($request->weight_kg);
        $zScoreBbTb = $standard->calculateZScoreBbTb($request->weight_kg);

        if ($zScoreTbU < -3) {
            $statusTbU = 'Sangat Pendek';
        } elseif ($zScoreTbU >= -3 && $zScoreTbU < -2) {
            $statusTbU = 'Pendek';
        } elseif ($zScoreTbU >= -2 && $zScoreTbU <= 2) {
            $statusTbU = 'Normal';
        } else {
            $statusTbU = 'Tinggi';
        }

        if ($zScoreBbU < -3) {
            $statusBbU = 'Sangat Kurus';
        } elseif ($zScoreBbU >= -3 && $zScoreBbU < -2) {
            $statusBbU = 'Kurus';
        } elseif ($zScoreBbU >= -2 && $zScoreBbU <= 1) {
            $statusBbU = 'Normal';
        } elseif ($zScoreBbU > 1 && $zScoreBbU <= 2) {
            $statusBbU = 'Gemuk';
        } else {
            $statusBbU = 'Sangat Gemuk';
        }

        if ($zScoreBbTb < -3) {
            $statusBbTb = 'Gizi Buruk';
        } elseif ($zScoreBbTb >= -3 && $zScoreBbTb < -2) {
            $statusBbTb = 'Gizi Kurang';
        } elseif ($zScoreBbTb >= -2 && $zScoreBbTb <= 1) {
            $statusBbTb = 'Gizi Baik (Normal)';
        } elseif ($zScoreBbTb > 1 && $zScoreBbTb <= 2) {
            $statusBbTb = 'Berisiko Gizi Lebih';
        } elseif ($zScoreBbTb > 2 && $zScoreBbTb <= 3) {
            $statusBbTb = 'Gizi Lebih';
        } else {
            $statusBbTb = 'Obesitas';
        }

        $measurement = new Measurement();
        $measurement->child_id = $child->id;
        $measurement->measured_at = $request->input('measured_at');
        $measurement->weight_kg = $request->input('weight_kg');
        $measurement->height_cm = $request->input('height_cm');
        $measurement->zscore_bb_u = $zScoreBbU;
        $measurement->zscore_tb_u = $zScoreTbU;
        $measurement->zscore_bb_tb = $zScoreBbTb;
        $measurement->bb_u_status = $statusBbU;
        $measurement->tb_u_status = $statusTbU;
        $measurement->bb_tb_status = $statusBbTb;
        $measurement->save();

        return back()->with('success', 'Pengukuran berhasil disimpan.');
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return back()->with('success', 'Pengukuran berhasil dihapus.');
    }
}
