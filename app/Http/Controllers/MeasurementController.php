<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\EducationContent;
use App\Models\Measurement;
use App\Models\NutritionStatus;
use App\Models\WhoStandard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    private function mapEducationCategory($statusBbU, $statusTbU, $statusBbTb)
    {
        // Prioritas utama = BB/TB
        return match ($statusBbTb) {
            'Gizi Buruk'  => ['pemulihan-gizi', 'rehabilitasi-gizi'],
            'Gizi Kurang' => ['peningkatan-gizi', 'mpasi-kalori-tinggi'],
            'Berisiko Gizi Lebih' => ['pencegahan-obesitas', 'atur-porsi'],
            'Gizi Lebih'  => ['diet-sehat-anak', 'aktivitas-fisik'],
            'Obesitas'    => ['obesitas-anak', 'kurangi-gula', 'aktivitas-fisik'],

            default => null
        } ?? match ($statusBbU) {
            'Berat Badan Sangat Kurang' => ['pemulihan-gizi', 'mpasi-kalori-tinggi'],
            'Berat Badan Kurang'        => ['peningkatan-berat-badan', 'mpasi-seimbang'],
            'Risiko Berat Badan Lebih'  => ['pencegahan-obesitas', 'atur-porsi'],

            default => null
        } ?? match ($statusTbU) {
            'Sangat Pendek' => ['stunting-berat', 'mikronutrien', 'tumbuh-kejar'],
            'Pendek'        => ['pencegahan-stunting', 'menu-pertumbuhan'],

            default => ['pola-makan-seimbang']
        };
    }

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
        $ageMonths = floor($ageInDays / 30.4375);
        $ageYears = floor($ageMonths / 12);

        $remMonths = $ageMonths % 12;
        $remDays = $ageInDays - ($ageYears * 365) - round($remMonths * 30.4375);

        if ($ageMonths < 24) {
            $bbtbIndicator = 'length'; // BB/PB
        } else {
            $bbtbIndicator = 'height'; // BB/TB
        }

        $standardTbU = WhoStandard::getStandard($ageInDays, $request->gender, 'height');
        $standardBbU = WhoStandard::getStandard($ageInDays, $request->gender, 'weight');
        $standardBbTb = WhoStandard::getBbTbStandard($request->height_cm, $request->gender, $bbtbIndicator);

        $zScoreTbU = $standardTbU->calculateZScoreTbU($request->height_cm);
        $zScoreBbU = $standardBbU->calculateZScoreBbU($request->weight_kg);
        $zScoreBbTb = $standardBbTb->calculateZScoreBbTb($request->weight_kg);

        // === KLASIFIKASI TB/U ===
        if ($zScoreTbU < -3)         $statusTbU = 'Sangat Pendek';
        elseif ($zScoreTbU < -2)     $statusTbU = 'Pendek';
        elseif ($zScoreTbU <= 3)     $statusTbU = 'Normal';
        else                         $statusTbU = 'Tinggi';

        // === KLASIFIKASI BB/U ===
        if ($zScoreBbU < -3)         $statusBbU = 'Berat Badan Sangat Kurang';
        elseif ($zScoreBbU < -2)     $statusBbU = 'Berat Badan Kurang';
        elseif ($zScoreBbU <= 1)     $statusBbU = 'Berat Badan Normal';
        else                         $statusBbU = 'Risiko Berat Badan Lebih';

        // === KLASIFIKASI BB/TB ===
        if ($zScoreBbTb < -3)        $statusBbTb = 'Gizi Buruk';
        elseif ($zScoreBbTb < -2)    $statusBbTb = 'Gizi Kurang';
        elseif ($zScoreBbTb <= 1)    $statusBbTb = 'Gizi Baik (Normal)';
        elseif ($zScoreBbTb <= 2)    $statusBbTb = 'Berisiko Gizi Lebih';
        elseif ($zScoreBbTb <= 3)    $statusBbTb = 'Gizi Lebih';
        else                         $statusBbTb = 'Obesitas';

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

        function color($status)
        {
            return match ($status) {
                'Sangat Pendek', 'Berat Badan Sangat Kurang', 'Gizi Buruk', 'Obesitas', 'Obesitas', 'Berisiko Gizi Lebih', 'Gizi Lebih', 'Risiko Berat Badan Lebih', 'Tinggi'
                => '#dc2626', // merah tua
                'Pendek', 'Berat Badan Kurang', 'Gizi Kurang', 'Risiko Gizi Lebih'
                => '#f59e0b', // kuning
                'Normal', 'Gizi Baik (Normal)', 'Berat Badan Normal'
                => '#22c55e', // hijau
                default => '#6b7280'
            };
        }

        $categories = $this->mapEducationCategory($statusBbU, $statusTbU, $statusBbTb);

        $recommendations = EducationContent::whereIn('category', $categories)
            ->limit(6)
            ->get();


        return back()->with('result', [
            'name'      => $child->name,
            'gender'    => $child->gender,
            'age_years' => $ageYears,
            'age_months' => $remMonths,
            'age_days'  => $remDays,
            'age_days_total' => $ageInDays,

            'weight' => $request->weight_kg,
            'weight_gram' => $request->weight_kg * 1000,
            'height' => $request->height_cm,

            'zscore_bbu'  => number_format($zScoreBbU, 2),
            'zscore_tbu'  => number_format($zScoreTbU, 2),
            'zscore_bbtb' => number_format($zScoreBbTb, 2),

            'status_bbu'  => $statusBbU,
            'status_tbu'  => $statusTbU,
            'status_bbtb' => $statusBbTb,

            'color_bbu'  => color($statusBbU),
            'color_tbu'  => color($statusTbU),
            'color_bbtb' => color($statusBbTb),

            'L_bbu' => $standardBbU->L,
            'M_bbu' => $standardBbU->M,
            'S_bbu' => $standardBbU->S,

            'SD1neg' => $standardTbU->SD1neg,
            'SD0' => $standardTbU->SD0,
            'SD1' => $standardTbU->SD1,
            'simpanganBaku' => ($standardTbU->SD1 - $standardTbU->SD1neg) / 2,

            'L_bbtb' => $standardBbTb->L,
            'M_bbtb' => $standardBbTb->M,
            'S_bbtb' => $standardBbTb->S,

            'recommendations' => $recommendations,
        ]);
    }
}
