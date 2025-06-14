<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * GET /api/comments
     * Liste les commentaires avec relations.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'post'])->latest()->get();

        return response()->json([
            'message' => 'Liste des commentaires',
            'comments' => CommentResource::collection($comments)
        ]);
    }

    /**
     * POST /api/comments
     * Ajoute un commentaire.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Auth::user()->comments()->create([
            'body' => $request->body,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'message' => 'Commentaire créé avec succès',
            'comment' => new CommentResource($comment->load(['user']))
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
