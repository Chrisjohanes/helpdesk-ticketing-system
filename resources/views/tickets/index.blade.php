@extends('layouts.app')

@section('content')

<div class="card mb-4">
    <div class="card-header">
        Filter Ticket
    </div>
    <div class="card-body">

        <form method="GET" action="/tickets" class="row g-3">

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="Open">Open</option>
                    <option value="On Progress">On Progress</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">All Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="date" name="date" class="form-control">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary w-100">
                    Filter
                </button>
            </div>

        </form>

    </div>
</div>

<div class="card">
    <div class="card-header">
        Ticket List
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ticket No</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_no }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->category->name }}</td>
                    <td>
                        <span class="badge 
                            @if($ticket->status == 'Open') bg-warning
                            @elseif($ticket->status == 'On Progress') bg-primary
                            @elseif($ticket->status == 'Resolved') bg-success
                            @elseif($ticket->status == 'Closed') bg-dark
                            @endif">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>
                        @if($ticket->status != 'Closed')
                        <form method="POST" action="/tickets/{{ $ticket->id }}/update-status">
                            @csrf

                            <div class="d-flex gap-2">
                                <select name="status" class="form-select form-select-sm">
                                    @if($ticket->status == 'Open')
                                        <option value="On Progress">On Progress</option>
                                    @elseif($ticket->status == 'On Progress')
                                        <option value="Resolved">Resolved</option>
                                    @elseif($ticket->status == 'Resolved')
                                        <option value="Closed">Closed</option>
                                    @endif
                                </select>

                                <input type="text" name="note" placeholder="Note"
                                       class="form-control form-control-sm">

                                <button type="submit" class="btn btn-sm btn-primary">
                                    Update
                                </button>
                            </div>
                        </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tickets->links() }}

    </div>
</div>

@endsection