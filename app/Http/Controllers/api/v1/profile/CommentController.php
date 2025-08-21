<?php

namespace App\Http\Controllers\api\v1\profile;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $comments = Comment::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return response()->json($comments);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        return response()->json([
            'message' => 'Comment deleted successfully',
        ]);

    }
}
