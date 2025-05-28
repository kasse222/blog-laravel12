<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::with('posts')->latest()->get();
    }

    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->validated());

        return response()->json([
            'message' => 'Tag créé avec succès',
            'data' => new TagResource($tag),
        ], 201);
    }


    public function show(Tag $tag)
    {
        return response()->json($tag->load('posts'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tag->id,
        ]);

        $tag->update(['name' => $request->name]);

        return response()->json(['message' => 'Tag mis à jour', 'tag' => $tag]);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(['message' => 'Tag supprimé']);
    }
}
