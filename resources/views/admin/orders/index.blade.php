@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Orders</h1>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Customer Number</th>
                <th>Email</th>
                <th>Payment Number</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->payment_phone }}</td>
                <td>Ksh {{ number_format($order->total_amount, 2) }}</td>
                <td>
                    <span class="badge 
                        @if($order->status == 'pending') bg-warning
                        @elseif($order->status == 'completed') bg-success
                        @elseif($order->status == 'canceled') bg-danger
                        @else bg-secondary @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
              <td>{{ $order->created_at_nairobi->format('Y-m-d H:i') }}</td>

                <td>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">View</a>
                    <!-- Optional: edit/delete buttons can go here -->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
@endsection
