<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index(){
        $user = Auth::user();
        $bookmarks = Bookmark::where('user_id',$user->id)->orderBy('created_at', 'desc')->get();
        return view('profile.bookmarks.index', compact('bookmarks'));
    }
    public function store(Request $request, Apartment $apartment)
    {
        $user = auth()->user();
        $user->bookmarks()->create([
            'apartment_id' => $apartment->id
        ]);

        return back()->with('success', 'Bookmark added successfully');
    }

    public function destroy(Bookmark $bookmark){
        $bookmark->delete();
        return back()->with('success', 'Bookmark deleted successfully');
    }
}
