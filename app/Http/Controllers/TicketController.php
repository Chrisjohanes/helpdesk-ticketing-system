<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\TicketLog;

class TicketController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $ticketNo = 'TCK-' . now()->format('YmdHis') . '-' . rand(100,999);

       auth()->loginUsingId(1); // sementara simulasi login

$ticket = Ticket::create([
    'ticket_no' => $ticketNo,
    'user_id' => auth()->id(),
    'category_id' => $request->category_id,
    'title' => $request->title,
    'description' => $request->description,
    'status' => 'Open'
]);

        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => 1,
            'new_status' => 'Open',
            'note' => 'Ticket created'
        ]);

        return "Ticket berhasil dibuat dengan nomor: " . $ticketNo;
    }

   public function index(Request $request)
{
    $query = \App\Models\Ticket::with(['user','category']);

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $tickets = $query->latest()->paginate(5);

    $categories = \App\Models\Category::all();

    return view('tickets.index', compact('tickets','categories'));
}

public function updateStatus(Request $request, $id)
{
    auth()->loginUsingId(1); // simulasi login
    if (auth()->user()->role !== 'it_support') {
    abort(403, 'Unauthorized - Only IT Support can update ticket.');
}
    $ticket = \App\Models\Ticket::findOrFail($id);

    $request->validate([
        'status' => 'required',
        'note' => 'nullable|string'
    ]);

    // VALIDASI TRANSISI STATUS (Anti Lompat)
    $allowedTransitions = [
        'Open' => ['On Progress'],
        'On Progress' => ['Resolved'],
        'Resolved' => ['Closed']
    ];

    $currentStatus = $ticket->status;
    $newStatus = $request->status;

    if (!isset($allowedTransitions[$currentStatus]) ||
        !in_array($newStatus, $allowedTransitions[$currentStatus])) {

        return back()->with('error', 'Status transition tidak valid!');
    }

    $oldStatus = $ticket->status;

    $ticket->update([
        'status' => $newStatus
    ]);

    \App\Models\TicketLog::create([
        'ticket_id' => $ticket->id,
        'user_id' => auth()->id(),
        'old_status' => $oldStatus,
        'new_status' => $newStatus,
        'note' => $request->note
    ]);

    return back()->with('success', 'Status berhasil diupdate!');
}
}