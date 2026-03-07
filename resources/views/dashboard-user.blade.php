<x-app-layout>

<div class="py-6">
<div class="max-w-7xl mx-auto">

<h2 class="text-2xl font-bold mb-6">
My Ticket Dashboard
</h2>

<div class="grid grid-cols-4 gap-6">

<div class="bg-white p-6 shadow rounded">
<p>My Tickets</p>
<p class="text-3xl font-bold">{{ $myTickets }}</p>
</div>

<div class="bg-red-100 p-6 shadow rounded">
<p>Open</p>
<p class="text-3xl font-bold">{{ $open }}</p>
</div>

<div class="bg-yellow-100 p-6 shadow rounded">
<p>On Progress</p>
<p class="text-3xl font-bold">{{ $progress }}</p>
</div>

<div class="bg-green-100 p-6 shadow rounded">
<p>Resolved</p>
<p class="text-3xl font-bold">{{ $resolved }}</p>
</div>

</div>

</div>
</div>

</x-app-layout>