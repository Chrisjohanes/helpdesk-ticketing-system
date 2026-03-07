<x-app-layout>

<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<h2 class="text-2xl font-bold mb-6">IT Support Dashboard</h2>

<div class="grid grid-cols-1 md:grid-cols-5 gap-6">

<!-- Total Ticket -->
<div class="bg-white shadow rounded-lg p-6">
<h3 class="text-gray-500">Total Tickets</h3>
<p class="text-3xl font-bold">{{ $total }}</p>
</div>

<!-- Open -->
<div class="bg-red-100 shadow rounded-lg p-6">
<h3 class="text-red-600">Open</h3>
<p class="text-3xl font-bold">{{ $open }}</p>
</div>

<!-- Progress -->
<div class="bg-yellow-100 shadow rounded-lg p-6">
<h3 class="text-yellow-600">On Progress</h3>
<p class="text-3xl font-bold">{{ $progress }}</p>
</div>

<!-- Resolved -->
<div class="bg-green-100 shadow rounded-lg p-6">
<h3 class="text-green-600">Resolved</h3>
<p class="text-3xl font-bold">{{ $resolved }}</p>
</div>

<!-- Closed -->
<div class="bg-blue-100 shadow rounded-lg p-6">
<h3 class="text-blue-600">Closed</h3>
<p class="text-3xl font-bold">{{ $closed }}</p>
</div>

</div>

</div>
</div>

</x-app-layout>