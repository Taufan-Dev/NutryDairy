<?php

namespace App\Http\Controllers;

use App\Models\EducationContent;
use Illuminate\Http\Request;

class EducationContentController extends Controller
{
    public function index()
    {
        $contents = EducationContent::orderBy('published_at', 'desc')->get();
        return view('education_contents.index', compact('contents'));
    }
}
