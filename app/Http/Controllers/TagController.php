<?php

namespace App\Http\Controllers;

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

        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Tag::class);

        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);
        $tag = new Tag();
        $tag->name = $request->input('name');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $tag->image = $image_name;

        }
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);

        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $tag->name = $request->input('name');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $tag->image = $imageName;
        }

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
