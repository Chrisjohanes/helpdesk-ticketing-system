@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Create Ticket
    </div>
    <div class="card-body">

        <form method="POST" action="/tickets">
            @csrf

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Submit Ticket
            </button>
        </form>

    </div>
</div>

@endsection