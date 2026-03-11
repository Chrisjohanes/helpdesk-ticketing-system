<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl">
Ticket Detail
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-4xl mx-auto">

<div class="bg-white shadow rounded p-6">

<h2 class="text-lg font-bold mb-4">
{{ $ticket->title }}
</h2>

<p class="mb-4">
{{ $ticket->description }}
</p>

<p class="text-sm text-gray-500 mb-4">
Status: {{ $ticket->status }}
</p>

@if(auth()->user()->isSupport())

<form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
@csrf
@method('PUT')

<label>Status</label>

<select name="status" class="border rounded p-2">

@if($ticket->status == 'Open')
<option value="On Progress">On Progress</option>
@endif

@if($ticket->status == 'On Progress')
<option value="Resolved">Resolved</option>
@endif

@if($ticket->status == 'Resolved')
<option value="Closed">Closed</option>
@endif

</select>

<label class="block mt-2">Note</label>
<textarea name="note" class="border rounded w-full"></textarea>

<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">
Update Status
</button>

</form>

@endif

<hr class="my-6">

<h2 class="text-lg font-bold mb-4">Activity Log</h2>

<table class="w-full border">

<thead>
<tr>
<th class="border p-2">User</th>
<th class="border p-2">Old Status</th>
<th class="border p-2">New Status</th>
<th class="border p-2">Note</th>
<th class="border p-2">Date</th>
</tr>
</thead>

<tbody>

@foreach($ticket->logs as $log)

<tr>
<td class="border p-2">{{ $log->user->name }}</td>
<td class="border p-2">{{ $log->old_status }}</td>
<td class="border p-2">{{ $log->new_status }}</td>
<td class="border p-2">{{ $log->note }}</td>
<td class="border p-2">{{ $log->created_at }}</td>
</tr>

@endforeach

</tbody>

</table>

</div>

</div>
</div>

</x-app-layout>