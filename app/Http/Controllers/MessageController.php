<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index($id): Response {
        try {
            $title = "Support Messages";
            $ticket = Ticket::findOrFail($id);
            return response()->view('admin.messages', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function messages($id): Response {
        try {
            $title = "Support Messages";
            $ticket = Ticket::findOrFail($id);
            return response()->view('customer.messages', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function fetch($ticketId) {
        try {
            $messages = Message::where('ticket_id', $ticketId)->orderBy('created_at', 'asc')->get(['content', 'user_id', 'created_at']);
            return response()->json(['messages' => $messages], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch messages', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
        }
    }

    public function send(Request $request) {
        try {
            $request->validate([
                'content' => ['required', 'string'],
                'ticket_id' => ['required', 'integer'],
            ]);
            Message::create([
                'ticket_id' => $request->ticket_id,
                'user_id' => Auth::user()->id,
                'content' => $request->content,
                'is_read' => false,
            ]);
            return response()->json(['success' => 'Message sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send message', 'message' => $e->getMessage()], 500);
        }
    }
}
