<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return response()->json([
        'message' => 'Liste des tags',
        'data' => TagResource::collection(Tag::withCount('posts')->latest()->get())
    ]);
    }

    public function store(StoreTagRequest $request)
    {
        // Autoriser explicitement l'action via la TagPolicy
        $this->authorize('create', Tag::class);

        // Si l'exécution continue ici, l'utilisateur est autorisé.
        $validatedData = $request->validated();
        $tag = Tag::create($validatedData);
        return response()->json($tag, 201);
    }


    public function show(Tag $tag)
    {
        return new TagResource($tag->load('posts'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return response()->json([
            'message' => 'Tag mis à jour',
            'data' => new TagResource($tag)
        ]);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(['message' => 'Tag supprimé avec succès.']);
    }
}
