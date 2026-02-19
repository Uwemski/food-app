<x-app-layout >

    <x-slot name='header'>
        <h3>Checkout page</h3>
    </x-slot>

    <div>
        <form action="{{route('cart.checkout.process')}}" method="post">
            @csrf

            <div>
                <label for="name">Full name</label>
                <input type="name" name="name"  id="name"  value="{{old('name', Auth::user()->name ?? '')}}">
            </div>
            <div>
                <label for="email">Email</label> 
                <input type="email" name="email" id="email" value="{{old('email', Auth::user()->email ?? '')}}">
            </div>
            <div>
                <label for="phone">Phone number</label>
                <input type="number" name="phone" id="phone" value="{{old('phone')}}" required>
            </div>
        
            <div>
                <label for="deliveryAddress">Delivery Address</label>
                <input type="deliveryAddress" id="deliveryAddress">
            </div>
            
            <div>
                <p>Order Summary</p>
                @if(session('cart') && count(session('cart')) > 0)

                @php $grandTotal = 0; @endphp

                <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                    <table border='1' class="w-full text-sm text-left rtl:text-right text-body">
                        <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Price (&#8358;)
                                </th>
                                <th scope="col" class="px-6 py-3 font-medium">
                                    Total (&#8358;)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(session('cart') as $key => $val)

                            @php
                                $itemTotal = $val['quantity'] * $val['price'];
                                $grandTotal += $itemTotal;
                            @endphp
                            <tr class="bg-neutral-primary border-b border-default">
                                <td class="px-6 py-4">
                                    {{$val['name']}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$val['quantity']}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$val['price']}}
                                </td>
                                <td class="px-6 py-4">
                                    {{number_format($itemTotal, 2)}}
                                </td>
                            </tr>
                            @empty
                            <div>
                                <p>Your cart is empty</p>
                            </div>
                            
                            @endforelse
                        </tbody>
                    </table>
                    <h3>Grand total: &#8358; {{number_format($grandTotal, 0)}}</h3>
                </div>
                <div>
                    <button type="submit">
                        Confirm & Place Order
                    </button>
                </div>
                @endif
            </div>
            

        </form>
    </div>
</x-app-layout>