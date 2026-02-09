<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all(); // prendo tutti gli articoli

        return view('pages.admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validazione dati
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:articles,slug|max:255',
            'excerpt' => 'required|string',
            'content' => 'nullable|json',
            'content_html' => 'nullable|string',
            'status' => 'required|in:published,draft,scheduled',
            'is_featured' => 'required|in:0,1',
        ]);

        // Slug per url friendly
        $slug = $this->slugify($request->slug, $request->title);

        $readingTime = $this->wordsCount($request->content_html);

        $isPublished = false;
        if ($request->status == 'published') {
            $isPublished = true;
        }

        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => json_encode(['body' => $request->content_html]),
            'content_html' => $request->content_html,
            // 'featured_image' => $request->featured_image,
            'meta_title' => $request->meta_title ?: $request->title,
            'meta_description' => $request->meta_description ?: $request->except,
            'status' => $request->status,
            'reading_time' => $readingTime,
            'published_at' => $isPublished ? now() : null,
            'is_featured' => $request->is_featured,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('pages.admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function forceDelete(Article $article)
    {
        $article->forceDelete();

        return redirect()->route('articles.index')->with('success', 'Article perma deleted successfully.');
    }

    public function restore(Article $article)
    {
        $article->restore();

        return redirect()->route('articles.index')->with('success', 'Article restored succesfully.');
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()->get();
        return view('pages.admin.articles.trashed', compact('articles'));
    }

    private function wordsCount($text)
    {
        $removeHtml = strip_tags($text);

        $wordCount = str_word_count($removeHtml);

        return max(1, ceil($wordCount / 200));
    }

    private function slugify($slug, $title = null)
    {
        return Str::slug($slug ?: $title);
    }
}
