<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    // GET /api/posts
    public function index()
    {
        $posts = Post::with(['user', 'tags'])->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    // POST /api/posts
    public function store(StorePostRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());

        if ($request->has('tags')) {
            $post->tags()->attach($request->input('tags'));
        }

        return response()->json([
            'message' => 'Article créé avec succès',
            'data' => new PostResource($post->load(['tags', 'user']))
        ], 201);
    }

    // GET /api/posts/{id}
    public function show($id)
    {
        $post = Post::with(['user', 'comments', 'tags'])->findOrFail($id);
        return new PostResource($post);
    }

    // PUT/PATCH /api/posts/{id}
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'content']));

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return response()->json([
            'message' => 'Article mis à jour avec succès',
            'data' => new PostResource($post->load(['tags', 'user'])),
        ]);
    }

    // DELETE /api/posts/{id}
    // DELETE /api/posts/{id}
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Vous n\'êtes pas autorisé à supprimer ce post.'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Article supprimé avec succès'
        ], 200);
    }
}
