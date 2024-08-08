<?php

namespace App\Http\Controllers;

use App\Models\StudentRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $studentrequest = StudentRequest::where('approved', False);

        $tags = Tag::all();

        return view('tags.index', compact('tags','studentrequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
        $studentrequest = StudentRequest::where('approved', False);
        return view('tags.create',compact('studentrequest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            

        ]);
        $tag = new Tag();
        $tag->name = $request->input('name');
        
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        $studentrequest = StudentRequest::where('approved', False);
        return view('tags.show', compact('tag','studentrequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        $studentrequest = StudentRequest::where('approved', False);
        return view('tags.edit', compact('tag','studentrequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
