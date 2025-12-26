<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('pages.catatanIbu', compact('notes'));
    }

    public function create()
    {
        return view('pages.createCatatanIbu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_menu' => 'required',
            'food_consumed' => 'required',
            'items' => 'required|array',
            'items.*.makanan' => 'required|string',
            'items.*.urt' => 'required|string',
            'items.*.gizi' => 'required|string',
            'photo' => 'nullable|image|max:8192',
        ]);

        // Upload foto jika ada
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('notes', 'public');
        }

        Note::create([
            'user_id' => Auth::id(),
            'food_menu' => $request->food_menu,
            'food_consumed' => $request->food_consumed,
            'items' => $request->items,
            'photo' => $photo,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil ditambahkan!');
    }
}
