<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\Ticket;
use App\Mail\TicketOpenedMail;
use App\Mail\TicketResponseMail;
use App\Mail\TicketClosedMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): Response {
        try {
            $title = "View Tickets";
            $tickets = Ticket::orderBy('created_at', 'DESC')->where('admin_id', Auth::user()->id)->get();
            $request = Ticket::whereNull('admin_id')->count();
            return response()->view('admin.tickets', get_defined_vars());
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
    public function store(Request $request): RedirectResponse {
        try {
            $ticket = Ticket::create([
                'customer_id' => Auth::user()->id,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'code' => 'TKT-' . strtoupper(uniqid()) . '-' . mt_rand(1000, 9999),
                'status' => Status::OPEN,
            ]);

            if ($ticket) {
                $admins = User::where('role', Role::ADMIN)->get();
                foreach ($admins as $key => $admin) {
                    Mail::to($admin->email)->send(new TicketOpenedMail($ticket));
                }
                return back()->with('success', 'Ticket opened successfully!!!');
            } else {
                return back()->with('error', 'An unexpected error occurred');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->update([
                'admin_id' => Auth::user()->id,
                'updated_at' => now(),
            ]);
            if ($ticket) {
                Mail::to($ticket->customer->email)->send(new TicketResponseMail($ticket));
                return redirect()->route('tickets.index')->with('success', 'Ticket responsed successfully!!!');
            } else {
                return back()->with('error', 'An unexpected error occurred');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket) {
        //
    }

    public function opened(): Response {
        try {
            $title = "Opened Tickets";
            $tickets = Ticket::orderBy('created_at', 'DESC')->whereNull('admin_id')->get();
            return response()->view('admin.opened', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function tickets(): Response {
        try {
            $title = "View Tickets";
            $tickets = Ticket::orderBy('created_at', 'DESC')->where('customer_id', Auth::user()->id)->get();
            return response()->view('customer.tickets', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function closed(Request $request, $id) {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->update([
                'status' => Status::CLOSE,
                'updated_at' => now(),
            ]);
            if ($ticket) {
                Mail::to($ticket->customer->email)->send(new TicketClosedMail($ticket));
                return back()->with('success', 'Ticket closed successfully!!!');
            } else {
                return back()->with('error', 'An unexpected error occurred');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
