<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Show All Users
     */
    public function index()
    {
        // Fetch all users
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Delete a User
     */
    public function destroy($id)
    {
        // Prevent admin from deleting themselves
        if($id == Auth::id()){
            return back()->with('message', ['You cannot delete yourself!']);
        }

        $user = User::find($id);

        if($user){
            $user->delete();
            return back()->with('success', 'User deleted successfully!');
        }

        return back()->with('message', ['User not found!']);
    }
}