<?php

namespace App\Http\Controllers\Admin;

use App\Models\EducationContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EducationContentController extends Controller
{
    public function index()
    {
        $contents = EducationContent::latest()->paginate(10);
        return view('admin.education_contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.education_contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'content' => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,png,jpeg|max:8192',
            'media_url' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $type = $request->media_type === 'article'
            ? 'pengetahuan'
            : 'keterampilan';

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            if (!$request->file('thumbnail')->isValid()) {
                return back()->withErrors([
                    'thumbnail' => 'File terlalu besar. Maksimum 8MB.',
                ])->withInput();
            }

            $thumbnailPath = $request->file('thumbnail')->store('education_contents', 'public');
        }

        EducationContent::create([
            'title' => $request->title,
            'type' => $type,
            'media_type' => $request->media_type,
            'category' => $request->category,
            'content' => $request->input('content'),
            'thumbnail' => $thumbnailPath,
            'media_url' => $request->media_url,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('education_contents.index')->with('success', 'Content created successfully.');
    }

    public function edit(EducationContent $educationContent)
    {
        return view('admin.education_contents.edit', compact('educationContent'));
    }

    public function update(Request $request, EducationContent $educationContent)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'media_type' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'content' => 'nullable|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,png,jpeg|max:8192',
            'media_url' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $type = $request->media_type === 'article'
            ? 'pengetahuan'
            : 'keterampilan';

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            if (!$request->file('thumbnail')->isValid()) {
                return back()->withErrors([
                    'thumbnail' => 'File terlalu besar. Maksimum 8MB.',
                ])->withInput();
            }

            $thumbnailPath = $request->file('thumbnail')->store('education_contents', 'public');
        }

        $educationContent->update([
            'title'        => $request->title,
            'type'         => $type,
            'media_type'   => $request->media_type,
            'category'     => $request->category,
            'content'      => $request->input('content'),
            'thumbnail'    => $thumbnailPath,
            'media_url'    => $request->media_url,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('education_contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy(EducationContent $educationContent)
    {
        if ($educationContent->thumbnail) {
            Storage::disk('public')->delete($educationContent->thumbnail);
        }

        $educationContent->delete();

        return redirect()->route('education_contents.index')
            ->with('success', 'Content deleted successfully.');
    }
}
