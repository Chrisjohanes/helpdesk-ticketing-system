<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
{
    if(auth()->user()->role == 'user'){

        $total = Ticket::where('user_id', auth()->id())->count();

        $open = Ticket::where('user_id', auth()->id())
            ->where('status', 'Open')->count();

        $progress = Ticket::where('user_id', auth()->id())
            ->where('status', 'On Progress')->count();

        // Closed dihitung sebagai Resolved untuk user
        $resolved = Ticket::where('user_id', auth()->id())
            ->whereIn('status', ['Resolved','Closed'])->count();

        $closed = 0;

    }else{

        // IT Support melihat status asli
        $total = Ticket::count();

        $open = Ticket::where('status', 'Open')->count();

        $progress = Ticket::where('status', 'On Progress')->count();

        $resolved = Ticket::where('status', 'Resolved')->count();

        $closed = Ticket::where('status', 'Closed')->count();
    }

    return view('dashboard', compact(
        'total',
        'open',
        'progress',
        'resolved',
        'closed'
    ));
}
}