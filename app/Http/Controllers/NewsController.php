<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.berita', compact('news'));
    }

    public function show(News $news)
    {
        if ($news->published_at > now()) {
            abort(404);
        }

        return view('pages.berita-detail', compact('news'));
    }
}
