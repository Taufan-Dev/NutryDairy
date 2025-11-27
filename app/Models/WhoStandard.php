<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhoStandard extends Model
{
    protected $table = 'who_standards';
    protected $guarded = [];

    public static function getStandard($ageInDays, $gender, $indicator)
    {
        return self::where('gender', $gender)
            ->where('age_value', $ageInDays)
            ->where('indicator', $indicator)
            ->first();
    }

    public static function getBbTbStandard($heightCm, $gender, $indicator)
    {
        return self::where('gender', $gender)
            ->where('indicator', $indicator)
            ->where('length_height_value', $heightCm)
            ->first();
    }

    public function calculateZScoreTbU($heightCm)
    {
        $M = $this->M;
        $SD1 = $this->SD1;
        $SD1neg = $this->SD1neg;
        $simpanganBaku = ($SD1 - $SD1neg) / 2;
        return ($heightCm - $M) / $simpanganBaku;
    }

    public function calculateZScoreBbU($weightKg)
    {
        $L = $this->L;
        $M = $this->M;
        $S = $this->S;
        return (($weightKg / $M) ** $L - 1) / ($S * $L);
    }

    public function calculateZScoreBbTb($weightKg)
    {
        $L = $this->L;
        $M = $this->M;
        $S = $this->S;
        return (($weightKg / $M) ** $L - 1) / ($S * $L);
    }
}
