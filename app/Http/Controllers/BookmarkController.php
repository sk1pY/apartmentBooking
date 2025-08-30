<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookmarks = Bookmark::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('profile.bookmarks.index', compact('bookmarks'));
    }

    public function store(Request $request)
    {
        //  Log::info(request('apartment_id'));

        $user = auth()->user();
        $apartment = Apartment::where('id', request('apartment_id'))->first();
        $bookmark = Bookmark::where(['apartment_id' => $apartment->id, 'user_id' => $user->id])->first();
        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['success' => true]);
        }
        $user->bookmarks()->create([
            'apartment_id' => $apartment->id
        ]);

        return response()->json(['success' => true,'store' => 'true']);
    }

    public function destroy(Bookmark $bookmark)
    {
        $cityId = $bookmark->apartment->city_id;
        $bookmark->delete();
        return redirect()->route('city.show', $cityId)->with('success', 'Bookmark deleted successfully');

    }
}
