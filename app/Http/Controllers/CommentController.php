<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * GET /api/comments
     * Liste les commentaires avec relations.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'post'])->latest()->get();
        return CommentResource::collection($comments);
    }

    /**
     * POST /api/comments
     * Ajoute un commentaire.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Commentaire ajouté avec succès.',
            'data' => new CommentResource($comment->load('user')),
        ], 201);
    }

    /**
     * GET /api/comments/{comment}
     * Affiche un commentaire précis.
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment->load(['user', 'post']));
    }

    /**
     * PUT/PATCH /api/comments/{comment}
     * Met à jour un commentaire (si propriétaire).
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $comment->update($request->validated());

        return response()->json([
            'message' => 'Commentaire mis à jour.',
            'data' => new CommentResource($comment),
        ]);
    }

    /**
     * DELETE /api/comments/{comment}
     * Supprime un commentaire (si propriétaire).
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Commentaire supprimé.']);
    }
}
