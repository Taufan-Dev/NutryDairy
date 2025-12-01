<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationContent;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('educationContent')->latest()->paginate(15);
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $contents = EducationContent::all();
        return view('admin.quizzes.create', compact('contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'education_content_id' => 'required',
            'type' => 'required|in:pretest,posttest',
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'answer' => 'required|string'
        ]);

        $options = array_map('trim', $request->options);
$options = array_filter($options);

        Quiz::create([
            'education_content_id' => $request->education_content_id,
            'type' => $request->type,
            'question' => $request->question,
            'options' => $options,
            'answer' => $request->answer
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz)
    {
        $contents = EducationContent::all();
        return view('admin.quizzes.edit', compact('quiz', 'contents'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'education_content_id' => 'required',
            'type' => 'required|string',
            'question' => 'required|string',
            'options' => 'required|array|min:2',
            'answer' => 'required|string'
        ]);

        $quiz->update([
            'education_content_id' => $request->education_content_id,
            'type' => $request->type,
            'question' => $request->question,
            'options' => json_encode($request->options),
            'answer' => $request->answer
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Soal berhasil dihapus.');
    }
}
