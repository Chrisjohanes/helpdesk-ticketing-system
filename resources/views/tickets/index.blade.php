<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Ticket List
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white shadow-md rounded-lg p-6">

<!-- FILTER -->
<form method="GET" class="grid md:grid-cols-4 gap-4 mb-6">
<div>
<label class="text-sm font-medium text-gray-700">Status</label>
<select name="status" class="w-full border-gray-300 rounded-md shadow-sm">

<option value="">All</option>
<option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
<option value="On Progress" {{ request('status') == 'On Progress' ? 'selected' : '' }}>On Progress</option>
<option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
<option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>

</select>
</div>

<div>
<label class="text-sm font-medium text-gray-700">Category</label>
<select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm">

<option value="">All</option>

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ request('category_id') == $category->id ? 'selected' : '' }}>

{{ $category->name }}

</option>

@endforeach

</select>
</div>

<div>
<label class="text-sm font-medium text-gray-700">Date</label>
<input 
type="date"
name="date"
value="{{ request('date') }}"
class="w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="flex items-end">
<button 
type="submit"
class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
Filter
</button>
</div>

</form>

<!-- TABLE -->

<div class="w-full overflow-x-auto">
    <table class="w-full divide-y divide-gray-200">
<thead class="bg-gray-50">

<tr>

<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
Title
</th>

<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
Category
</th>

<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
Status
</th>

<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
Created
</th>

<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
Action
</th>

<th>Priority</th>

<th>Ticket No</th>
</tr>

</thead>

<tbody class="bg-white divide-y divide-gray-200">

@forelse($tickets as $ticket)

<tr>

<td class="px-6 py-4">
{{ $ticket->title }}
</td>

<td class="px-6 py-4">
{{ $ticket->category->name ?? '-' }}
</td>

<td class="px-6 py-4">

<span class="px-2 py-1 rounded text-xs font-semibold
@if($ticket->status == 'Open') bg-red-100 text-red-700
@elseif($ticket->status == 'On Progress') bg-yellow-100 text-yellow-700
@elseif($ticket->status == 'Resolved') bg-green-100 text-green-700
@elseif($ticket->status == 'Closed') bg-gray-200 text-gray-700
@endif
">

@if(auth()->user()->role == 'user' && $ticket->status == 'Closed')
Resolved
@else
{{ $ticket->status }}
@endif

</span>

</td>

<td class="px-6 py-4 text-sm text-gray-500">
{{ $ticket->created_at->format('d M Y') }}
</td>

<td class="px-6 py-4">

<a href="{{ route('tickets.show', $ticket->id) }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">

View

</a>

</td>

<td>
<span class="px-2 py-1 rounded text-xs font-semibold
@if($ticket->priority == 'High') bg-red-100 text-red-700
@elseif($ticket->priority == 'Medium') bg-yellow-100 text-yellow-700
@else bg-green-100 text-green-700
@endif
">

{{ $ticket->priority }}

</span>
</td>

<td>{{ $ticket->ticket_no }}</td>
</tr>

@empty

<tr>
<td colspan="5" class="text-center py-6 text-gray-500">
No tickets found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

<!-- PAGINATION -->

<div class="flex justify-center mt-6">
{{ $tickets->withQueryString()->links('pagination::tailwind') }}
</div>

</div>

</div>
</div>

</x-app-layout>