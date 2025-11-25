<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhoStandard extends Model
{
    protected $table = 'who_standards';
    protected $guarded = [];

    public static function getStandard($ageInDays, $gender)
    {
        return self::where('gender', $gender)
                ->where('age_value', $ageInDays)
                ->first();
            
    }

    public function calculateZScoreTbU($heightCm)
    {
        $L = $this->L;
        $M = $this->M;
        $S = $this->S;
        return ($heightCm - $M) / $S;
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
