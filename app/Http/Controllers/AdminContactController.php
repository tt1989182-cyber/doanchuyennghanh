<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    // Hiển thị danh sách tin nhắn
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('backend.contact.index', compact('messages'));
    }

    // Hiển thị chi tiết 1 tin nhắn
    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('backend.contact.show', compact('message'));
    }
}
