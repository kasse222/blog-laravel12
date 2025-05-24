<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    // GET /api/posts
    public function index()
    {
        return Post::with(['user', 'tags', 'comments'])->latest()->get();
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
            'post' => $post->load('tags')
        ], 201);
    }

    // GET /api/posts/{id}
    public function show($id)
    {
        $post = Post::with(['user', 'comments', 'tags'])->findOrFail($id);
        return response()->json($post);
    }

    // PUT/PATCH /api/posts/{id}
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'content']));
        return response()->json($post);
    }

    // DELETE /api/posts/{id}
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Supprimé']);
    }
}
