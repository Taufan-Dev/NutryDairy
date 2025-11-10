<?php

namespace App\Http\Controllers;

use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function index()
    {
        $children = Children::where('parent_id', auth()->id())->get();
        return view('children.index', compact('children'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'gender' => 'required',
        ]);

        Children::create([
            'parent_id' => auth()->id(),
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
        ]);

        return redirect()->route('children.index');
    }

    public function show(Children $child)
    {
        $this->authorizeChild($child);
        
        return view('children.show', compact('child'));
    }

    public function update(Request $request, Children $child)
    {
        $this->authorizeChild($child);

        $child->update($request->all());
        return redirect()->route('children.index');
    }

    public function destroy(Children $child)
    {
        $this->authorizeChild($child);

        $child->delete();
        return response()->json(['message' => 'Deleted']);
    }

    private function authorizeChild($child) 
    {
        if ($child->parent_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }
}
