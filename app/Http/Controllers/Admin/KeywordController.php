<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddKeywordRequest;
use App\Http\Requests\UpdateKeywordRequest;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.keyword.index')->with([
            'keywords' => Keyword::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keyword.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddKeywordRequest $request)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);
            Keyword::create($data);
            return redirect()->route('admin.keyword.index')->with([
                'success' => 'Keyword created successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keyword $keyword)
    {
        return view('admin.keyword.edit')->with([
            "keyword" => $keyword
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeywordRequest $request, Keyword $keyword)
    {
        if ($request->validated()) {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);
            $keyword->update($data);
            return redirect()->route('admin.keyword.index')->with([
                "success" => "Keyword updated successfully"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keyword $keyword)
    {
        $keyword->delete();
        return redirect()->route('admin.keyword.index')->with([
            "success" => "Keyword deleted successfully"
        ]);
    }
}
