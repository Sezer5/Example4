<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.article.index')->with([
            'articles' => Article::with(['keywords'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.article.create')->with([
            'keywords' => Keyword::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddArticleRequest $request)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            $article = Article::create($data);
            $article->keywords()->sync($request->keyword_id);
            return redirect()->route('admin.article.index')->with([
                'success' => 'Article Created Successtully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.article.edit')->with([
            'article' => $article->load('keywords'),
            'keywords' => Keyword::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        if ($request->validated()) {
            $data = $request->validated();
            if ($request->has('thumbnail')) {
                $this->removeImage($article->thumbnail);
            };
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            $article->update($data);
            $article->keywords()->sync($request->keyword_id);
            return redirect()->route('admin.article.index')->with([
                'success' => 'Article Updated Completely'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->removeImage($article->thumbnail);
        $article->delete();
        return redirect()->route('admin.article.index')->with([
            'success' => 'Article deleted successfully'
        ]);
    }

    public function saveImage($file)
    {
        $file_name = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('images/articles', $file_name, 'public');
        return 'storage/images/articles/' . $file_name;
    }

    public function removeImage($file)
    {
        $path = public_path($file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
