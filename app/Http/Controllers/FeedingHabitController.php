<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\FeedingHabit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedingHabitController extends Controller
{
    public function store(Request $request, Children $child)
    {
        if ($child->parent_id !== Auth::id()) abort(403);

        FeedingHabit::create([
            'child_id' => $child->id,
            'filled_at' => now(),
            'meals_per_day' => $request->meals_per_day,
            'veg_fruit_freq' => $request->veg_fruit_freq,
            'milk_freq' => $request->milk_freq,
            'snack_freq' => $request->snack_freq,
        ]);

        return back()->with('success', 'Form kebiasaan makan telah dikirim.');
    }
}
