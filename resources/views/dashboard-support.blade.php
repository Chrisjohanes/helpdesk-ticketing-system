<x-app-layout>

<div class="py-6">
<div class="max-w-7xl mx-auto">

<h2 class="text-2xl font-bold mb-6">
IT Support Dashboard
</h2>

<div class="grid grid-cols-5 gap-6">

<div class="bg-white p-6 shadow rounded">
<p>Total Tickets</p>
<p class="text-3xl font-bold">{{ $total }}</p>
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

<div class="bg-blue-100 p-6 shadow rounded">
<p>Closed</p>
<p class="text-3xl font-bold">{{ $closed }}</p>
</div>

</div>

</div>
</div>

</x-app-layout>