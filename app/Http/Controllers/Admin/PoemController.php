<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPoemRequest;
use App\Http\Requests\UpdatePoemRequest;
use App\Models\Keyword;
use App\Models\Poem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PoemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.poem.index')->with([
            'poems' => Poem::with(['keywords'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poem.create')->with([
            'keywords' => Keyword::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPoemRequest $request)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            $poem = Poem::create($data);
            $poem->keywords()->sync($request->keyword_id);
            return redirect()->route('admin.poem.index')->with([
                'success' => 'Poem created successfully'
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
    public function edit(Poem $poem)
    {
        return view('admin.poem.edit')->with([
            'poem' => $poem->load('keywords'),
            'keywords' => Keyword::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePoemRequest $request, Poem $poem)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $this->deleteImage($poem->thumbnail);
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            $poem->update($data);
            $poem->keywords()->sync($request->keyword_id);
            return redirect()->route('admin.poem.index')->with([
                'success' => 'Poem updated successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poem $poem)
    {
        $this->deleteImage($poem->thumbnail);
        $poem->delete();
        return redirect()->route('admin.poem.index')->with([
            'success' => 'Poem deleted successfully'
        ]);
    }

    public function saveImage($file)
    {
        $path = $file->store('images/poems', 'public');

        return 'storage/' . $path;
    }

    public function deleteImage($file)
    {
        $path = public_path($file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
