<x-layouts.dashboard title="Admin Dashboard">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <x-stat-card title="Users" value="{{$users}}" />
        <x-stat-card title="Orders" value="320" />
        <x-stat-card title="Revenue" value="₦540,000" />
        <x-stat-card title="Pending" value="12" />
        
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
        <p class="text-gray-600">Your admin content goes here.</p>
    </div>

</x-layouts.dashboard>
