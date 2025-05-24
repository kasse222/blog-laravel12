<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::with(['user', 'post'])->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
        'user_id' => auth()->id(),
        'post_id' => $request->input('post_id'),
        'body' => $request->input('body'),
    ]);

    return response()->json([
        'message' => 'Commentaire ajouté',
        'comment' => $comment->load('user')
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json($comment->load(['user', 'post']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $comment->update($request->only('body'));
        return response()->json([
            'message' => 'Commentaire mis à jour',
            'comment' => $comment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Commentaire supprimé']);
    }
}
