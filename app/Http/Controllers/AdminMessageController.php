<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Import Message Model

class AdminMessageController extends Controller
{
    /**
     * Show All Messages
     */
    public function index()
    {
        // Get all messages
        $messages = Message::all();
        return view('admin.contacts', compact('messages'));
    }

    /**
     * Delete a Message
     */
    public function destroy($id)
    {
        $message = Message::find($id);

        if($message){
            $message->delete();
            return back()->with('success', 'Message deleted successfully!');
        }

        return back()->with('message', ['Message not found!']);
    }
}