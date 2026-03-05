@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h5>Total Tickets</h5>
                <h3>{{ $total }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-dark bg-warning">
            <div class="card-body">
                <h5>Open</h5>
                <h3>{{ $open }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5>On Progress</h5>
                <h3>{{ $progress }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>Resolved</h5>
                <h3>{{ $resolved }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <h5>Closed</h5>
                <h3>{{ $closed }}</h3>
            </div>
        </div>
    </div>

</div>

<a href="/tickets" class="btn btn-outline-primary mt-3">
    View All Tickets
</a>

@endsection