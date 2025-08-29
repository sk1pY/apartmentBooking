<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Apartment $apartment)
    {
        $validate = $request->validate([
            'text' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $user = $request->user();
        $validate['user_id'] = $user->id;
        $comment = $apartment->comments()->create($validate);

        $rating = $apartment->comments()->avg('rating');

        $apartment->avgRating = $rating;
        $apartment->save();

        return back()->with('success', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment, Comment $comment)
    {
        abort_if($apartment->id != $comment->apartment->id, 403);
        $this->authorize('update', $comment);
        $validate = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->update($validate);
        return back()->with('success', 'Comment updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment, Comment $comment)
    {
        abort_if($apartment->id !== $comment->apartment->id, 403);
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
