<x-app-layout>

    <x-slot name='header'>

    </x-slot>

    <div class="">
        <div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">

            <div class="max-w-6xl mx-auto">
                
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">
                        Your Cart
                    </h1>

                    <a href="{{ route('shop.index') }}"
                    class="mt-4 mb-4 sm:mt-0 bg-orange-600 text-white px-5 py-2 rounded-lg shadow hover:bg-orange-700 transition">
                        Continue Shopping
                    </a>
                </div>

                <!-- Cart Container -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-6">
                        @if(session('success'))
                            <div>{{session('success')}}</div>
                        @endif

                        @if(session('cleared'))
                            <div>{{session('cleared')}}</div>
                        @endif

                        @if(session('error'))
                            <div>{{session('error')}}</div>
                        @endif


                        @php $grandTotal =0;  @endphp

                        @php $total = 0; @endphp
                        @forelse($cartItems as $id => $item)
                        <div class="bg-white rounded-xl shadow-sm p-5 flex flex-col sm:flex-row items-center sm:items-start gap-6">

                            <!-- Image -->
                            <img src=""
                                alt="{{ $item['name'] }}"
                                class="w-24 h-24 object-cover rounded-lg">

                            <!-- Details -->
                            <div class="flex-1 w-full">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-semibold text-gray-800">
                                       Name: {{ $item['name'] }}
                                    </h2>

                                    <form action="{{route('cart.removeItem', $id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700 text-sm">
                                            Remove
                                        </button>
                                    </form>
                                </div>

                                <p class="text-sm text-gray-500 mt-1">
                                    Price: ₦{{ number_format($item['price'], 2) }}
                                </p>

                                <!-- Quantity -->
                                <div class="mt-4 flex items-center gap-3">
                                    <form action="" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')

                                        <input type="number"
                                            name="quantity"
                                            value="{{ $item['quantity'] }}"
                                            min="1"
                                            class="w-20 border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-orange-500">

                                        <button type="submit"
                                                class="bg-orange-600 text-white px-4 py-1 rounded-md hover:bg-orange-700 transition">
                                            Update
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Subtotal -->
                             
                             @php $subTotal = $item['price'] * $item['quantity']; @endphp
                            <div class="text-right">
                                <p class="text-gray-600 text-sm">Subtotal</p>
                                <p class="text-lg font-bold text-gray-800">
                                    ₦{{ number_format($subTotal, 2) }}
                                </p>
                            </div>
                        </div>
                     
                        @php $total += $subTotal; @endphp

                        @php $grandTotal += $total; @endphp
                        @empty
                        <div class="bg-white p-10 text-center rounded-xl shadow-sm">
                            <p class="text-gray-600 text-lg">
                                Your cart is empty.
                            </p>
                        </div>
                        @endforelse

                    </div>

                    <!--Clear Cart-->
                    <div>
                        <form action="{{route('cart.clear')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button>Clear cart</button>
                        </form>
    
                    </div>


                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl shadow-sm p-6 h-fit">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">
                            Order Summary
                        </h2>
                    
                        <div class="space-y-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>₦{{ number_format($total ?? 0, 2) }}</span>
                            </div>

                            <div class="flex justify-between text-gray-600">
                                <span>Delivery</span>
                                <span>₦1,500.00</span>
                            </div>

                            <hr>

                            <div class="flex justify-between font-bold text-lg text-gray-800">
                                <span>Total</span>
                                <span>
                                    ₦{{ number_format(($grandTotal ?? 0) + 1500, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <form action="{{route('checkout.index')}}" method="GET" class="mt-8">
                            <button type="submit"
                                    class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition shadow">
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>