<?php

namespace App\Http\Controllers;

use App\Models\EducationContent;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function home()
    {
        return view('pages.artikel', [
            'pengetahuan' => EducationContent::where('type', 'pengetahuan')->latest()->take(5)->get(),
            'keterampilan' => EducationContent::where('type', 'keterampilan')->latest()->take(5)->get(),
        ]);
    }


    public function list($category)
    {
        $contents = EducationContent::where('type', $category)->get();
        return view('pages.listArtikel', compact('contents', 'category'));
    }


    public function detail($slug)
    {
        $content = EducationContent::where('slug', $slug)->firstOrFail();

        $pretestQuestions = Quiz::where('education_content_id', $content->id)
            ->where('type', 'pretest')
            ->get();

        $posttestQuestions = Quiz::where('education_content_id', $content->id)
            ->where('type', 'posttest')
            ->get();

        // Ambil hasil
        $pretestResult = QuizResult::where('user_id', Auth::id())
            ->where('education_content_id', $content->id)
            ->where('type', 'pretest')
            ->first();

        $posttestResult = QuizResult::where('user_id', Auth::id())
            ->where('education_content_id', $content->id)
            ->where('type', 'posttest')
            ->first();

        return view('pages.detailArtikel', compact(
            'content',
            'pretestQuestions',
            'posttestQuestions',
            'pretestResult',
            'posttestResult',
        ));
    }

    public function submitPretest(Request $request, $id)
    {
        $content = EducationContent::findOrFail($id);

        $questions = Quiz::where('education_content_id', $id)
            ->where('type', 'pretest')
            ->get();

        $request->validate([
            'answers' => 'required|array',
        ]);

        $score = 0;

        foreach ($questions as $q) {
            if (isset($request->answers[$q->id]) && $request->answers[$q->id] == $q->answer) {
                $score++;
            }
        }

        QuizResult::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'education_content_id' => $id,
                'type' => 'pretest',
            ],
            [
                'score' => $score,
            ]
        );

        return redirect()->route('article.detail', $content->slug)
            ->with('success', 'Pretest selesai! Silakan lanjut ke materi.')
            ->with('show_posttest', true);
    }

    public function submitPosttest(Request $request, $id)
    {
        $content = EducationContent::findOrFail($id);

        $questions = Quiz::where('education_content_id', $id)
            ->where('type', 'posttest')
            ->get();

        $request->validate([
            'answers' => 'required|array',
        ]);

        $score = 0;
        foreach ($questions as $q) {
            if (isset($request->answers[$q->id]) && $request->answers[$q->id] == $q->answer) {
                $score++;
            }
        }

        QuizResult::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'education_content_id' => $id,
                'type' => 'posttest',
            ],
            [
                'score' => $score,
            ]
        );

        session(["posttest_done_$id" => true]);

        return back()->with('success', 'Posttest selesai! Terima kasih sudah belajar ❤️');
    }
}
