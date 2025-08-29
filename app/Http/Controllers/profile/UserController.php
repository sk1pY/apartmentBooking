<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('profile.user.index', compact('user'));
    }

    public function edit(){
        return view('profile.user.edit');
    }
    public function update(Request $request){
        $user = auth()->user();

        $user->update([
            'name' => $request->input('name'),
        ]);
        return back()->with('success','profile updated successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('index');

    }

}
