<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketLog;
use App\Models\Category;

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
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'priority' => 'required'
        ]);

        $ticketNo = 'TCK-' . date('YmdHis');

        Ticket::create([
            'ticket_no' => $ticketNo,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => 'Open',
            'priority' => $request->priority
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully');
    }

   public function index(Request $request)
{
    $query = Ticket::with(['user','category']);

    // user biasa hanya boleh lihat ticket miliknya
    if(auth()->user()->role == 'user'){
        $query->where('user_id', auth()->id());
    }

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
    $categories = Category::all();

    return view('tickets.index', compact('tickets','categories'));
}

    public function show($id)
    {
        $ticket = Ticket::with(['user','category','logs.user'])->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        // hanya IT Support yang boleh update
       if (auth()->user()->role != 'it_support') {
    abort(403);
}

        $request->validate([
            'status' => 'required'
        ]);

        $ticket = Ticket::findOrFail($id);

        $oldStatus = $ticket->status;
        $newStatus = $request->status;

        // aturan perubahan status
        $allowedTransitions = [
            'Open' => ['On Progress'],
            'On Progress' => ['Resolved'],
            'Resolved' => ['Closed']
        ];

        if (isset($allowedTransitions[$oldStatus])) {
            if (!in_array($newStatus, $allowedTransitions[$oldStatus])) {
                return back()->with('error', 'Status transition tidak valid!');
            }
        }

        // update status ticket
        $ticket->update([
            'status' => $newStatus
        ]);

        // simpan log perubahan
        TicketLog::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'note' => $request->note
        ]);

        return back()->with('success','Status berhasil diupdate!');
    }

    public function dashboard()
    {
        // dashboard IT Support
        if(auth()->user()->role == 'it_support'){

            $total = Ticket::count();
            $open = Ticket::where('status','Open')->count();
            $progress = Ticket::where('status','On Progress')->count();
            $resolved = Ticket::where('status','Resolved')->count();
            $closed = Ticket::where('status','Closed')->count();

            return view('dashboard-support', compact(
                'total',
                'open',
                'progress',
                'resolved',
                'closed'
            ));
        }

        // dashboard user biasa
        $myTickets = Ticket::where('user_id', auth()->id())->count();

        $open = Ticket::where('user_id', auth()->id())
            ->where('status','Open')->count();

        $progress = Ticket::where('user_id', auth()->id())
            ->where('status','On Progress')->count();

        $resolved = Ticket::where('user_id', auth()->id())
            ->where('status','Resolved')->count();

        return view('dashboard-user', compact(
            'myTickets',
            'open',
            'progress',
            'resolved'
        ));
    }
}