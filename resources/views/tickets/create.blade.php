<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Ticket
    </h2>
</x-slot>

<div class="py-6">
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white shadow-md rounded-lg p-6">

@if ($errors->any())
<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ route('tickets.store') }}" class="space-y-6">
@csrf

<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Title
</label>
<input 
type="text"
name="title"
class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
required>
</div>

<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Description
</label>
<textarea 
name="description"
rows="4"
class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
required></textarea>
</div>

<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Category
</label>
<select 
name="category_id"
class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

@foreach($categories as $category)
<option value="{{ $category->id }}">
{{ $category->name }}
</option>
@endforeach

</select>
</div>

<div>
<label class="block text-sm font-medium text-gray-700 mb-1">
Priority
</label>

<select name="priority"
class="w-full border-gray-300 rounded-md shadow-sm">

<option value="Low">Low</option>
<option value="Medium" selected>Medium</option>
<option value="High">High</option>

</select>
</div>

<div>
<button 
type="submit"
class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md shadow">
Submit Ticket
</button>
</div>

</form>

</div>
</div>
</div>

</x-app-layout>