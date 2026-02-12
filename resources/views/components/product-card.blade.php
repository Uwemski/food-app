@props(['product'])

<div class="bg-white rounded-lg shadow hover:shadow-lg transition">

    <!-- Product Image -->
    <div class="h-48 bg-gray-100 flex items-center justify-center">
        @if($product->image)
            <img 
                src="{{ asset('/products/'.$product->image[0]) }}" 
                alt="{{ $product->name }}"
                class="h-full object-cover"
            >
        @else
            <span class="text-gray-400 text-sm">No Image</span>
        @endif
    </div>

    <!-- Product Details -->
    <div class="p-4">
        <h2 class="font-semibold text-lg">
            {{ $product->name }}
        </h2>

        <p class="text-sm text-gray-600 mt-1">
            {{ Str::limit($product->description, 60) }}
        </p>

        <div class="flex items-center justify-between mt-4">
            <span class="text-green-600 font-bold">
                ₦{{ number_format($product->price, 2) }}
            </span>

            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <button
                    type="submit"
                    class="bg-green-600 text-dark text-sm px-4 py-2 rounded hover:bg-green-700 transition"
                >
                    Add to Cart
                </button>
            </form>
        </div>
    </div>

</div>
