{{-- @extends('frontend.layout.main')

@section('main-container')
    <div class="card mt-4 mb-2" style="width: 65rem; height: auto; margin: 0 auto; margin-bottom:20px;"> <!-- Center the card -->
        <div class="card-body">
            <h2 class="card-title text-center mt-3 mb-3" style="text-align: center; margin-bottom: 20px;">Order History</h2> <!-- Center the title -->

            @if(session('order_cancelled'))
            <div class="alert alert-success" role="alert">
                {{ session('order_cancelled') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

            @if($orders->isNotEmpty())
                <div style="overflow-x: auto; text-align: center;">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product</th>
                                <th>Total Cost</th>
                                <th>Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $reversedOrders = $orders->reverse();
                            @endphp
                            @foreach($reversedOrders as $order)
                                <tr>
                                    <td>{{ $order->order_id ?: '-' }}</td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0; text-align: left;"> <!-- Align product names to the left -->
                                            @php
                                                $Productnames = explode(',', $order->product_name);
                                            @endphp
                                            @foreach ($Productnames as $name)
                                                <li>{{ $name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>₹{{ $order->total_cost }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <form action="{{ route('order.cancel', $order->order_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p style="text-align: center;">No orders found.</p>
            @endif
        </div>
    </div>
@endsection --}}
@extends('frontend.layout.main')

@section('main-container')
    <div class="card mt-4 mb-2" style="max-width: 100%; width: 90%; margin: 0 auto; margin-bottom: 20px;">
        <div class="card-body">
            <h2 class="card-title text-center mt-3 mb-3" style="margin-bottom: 20px;">Order History</h2>
            @if($orders->isNotEmpty())
                <!-- Responsive table wrapper -->
                <div class="table-responsive" style="text-align: center;">
                    <table class="table table-bordered text-center" >
                        <thead>
                            <tr>
                                <th style="text-align: center;">Order ID</th>
                                <th style="text-align: center;">Product</th>
                                <th style="text-align: center;">Total Cost</th>
                                <th style="text-align: center;">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $reversedOrders = $orders->reverse();
                            @endphp
                            @foreach($reversedOrders as $order)
                                <tr>
                                    <td style="font-size: 1.2em;">{{ $order->order_id ?: '-' }}</td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;">
                                            @php
                                                $Productnames = explode(',', $order->product_name);
                                            @endphp
                                            @foreach ($Productnames as $name)
                                                <li>{{ $name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="font-size: 1.2em;">₹{{ $order->total_cost }}</td>
                                    <td style="font-size: 1.2em;">{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- <div class="d-flex justify-content-center" style="display: flex; justify-content: center;">
                    {{ $orders->links() }}
                </div> --}}



            @else
                <p style="text-align: center;">No orders found.</p>
            @endif
        </div>
    </div>



@endsection


