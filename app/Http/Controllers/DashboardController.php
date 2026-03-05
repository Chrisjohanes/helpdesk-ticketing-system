<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Ticket::count();
        $open = Ticket::where('status', 'Open')->count();
        $progress = Ticket::where('status', 'On Progress')->count();
        $resolved = Ticket::where('status', 'Resolved')->count();
        $closed = Ticket::where('status', 'Closed')->count();

        return view('dashboard', compact(
            'total',
            'open',
            'progress',
            'resolved',
            'closed'
        ));
    }
}