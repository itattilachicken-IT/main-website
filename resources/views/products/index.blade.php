@extends('layouts.app')

@section('title', 'Our Chicken Products - Attila Chicken')

@section('content')
<div class="container my-5">
    <h1 class="fw-bold text-danger mb-4">Our Chicken Products - Attila Chicken</h1>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="Attila {{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Attila {{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>

                        {{-- ✅ Only View for users --}}
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-danger">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
