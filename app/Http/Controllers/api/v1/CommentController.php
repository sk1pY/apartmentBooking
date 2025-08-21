<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Comment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index(Apartment $apartment)
    {
        $comments = $apartment->comments()->get();
        return response()->json($comments);
    }

    public function store(Request $request, Apartment $apartment)
    {
        $validate = $request->validate([
            'text' => 'required|string',
        ]);

        $user = $request->user();
        $validate['user_id'] = $user->id;
        $comment = $apartment->comments()->create($validate);

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment,
        ], 201);
    }


    public function update(Request $request, Apartment $apartment, Comment $comment)
    {

        abort_if($apartment->id != $comment->apartment->id, 403);
        $this->authorize('update', $comment);
        $validate = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->update($validate);

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => $comment,
        ]);
    }


    public function destroy(Apartment $apartment, Comment $comment)
    {
        abort_if($apartment->id != $comment->apartment->id, 403);
        $this->authorize('delete', $comment);

        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted successfully',
        ]);
    }
}
