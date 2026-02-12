<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Shop Products
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div>
            @if(session('success'))
                <p class='text-green-700'>{{session('success')}}</p>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</x-app-layout>
