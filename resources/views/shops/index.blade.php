@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.routes') 

    <h1 class="mb-4 fw-bold text-danger">Our Chicken Products - Attila Chicken</h1>

    <div class="row">
        @foreach($products as $product)
            @if($product->slug)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        @php $imagePath = trim($product->image_url ?? ''); @endphp
                        <img src="{{ $imagePath ? asset(ltrim($imagePath, '/')) : asset('placeholder.jpg') }}" 
                             class="card-img-top" 
                             alt="Attila {{ $product->name }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold" style="font-size: 1.2rem;">
                                Attila {{ $product->name }}
                            </h5>

                            <p class="card-text text-muted">
                                {{ Str::limit($product->description, 50) }}
                            </p>

                            @if($product->variants->count() > 0)
                                <p>
                                    <strong>
                                        From KSh {{ number_format($product->variants->min('price'), 2) }}
                                        - {{ number_format($product->variants->max('price'), 2) }}
                                    </strong>
                                </p>
                            @else
                                <p>
                                    <strong>
                                        KSh {{ number_format($product->price_per_kg, 2) }} /kg
                                    </strong>
                                </p>
                            @endif

                            <div class="d-flex gap-1 mt-auto">
                                <a href="{{ route('shop.show', $product->slug) }}" 
                                   class="btn flex-fill text-white fw-bold text-capitalize"
                                   style="background-color: var(--brand-black); font-size: 0.8rem;">
                                    View Product
                                </a>

                                <button type="button" 
                                        class="btn flex-fill fw-bold text-white text-capitalize add-to-cart"
                                        style="background-color: var(--brand-red); font-size: 0.8rem;"
                                        data-id="{{ $product->id }}"
                                        data-has-variants="{{ $product->variants->count() > 0 ? '1' : '0' }}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Floating Cart Wrapper -->
<div id="floating-cart-wrapper">
    <a href="javascript:void(0)" id="floating-cart">
        <span class="cart-icon">&#128722;</span>
        <span class="cart-label">Cart</span>
        <span id="cart-count">{{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</span>
    </a>

    <!-- Mini Cart Dropdown -->
    <div id="mini-cart" class="shadow p-2 bg-white rounded" style="display:none;">
        @if(session('cart') && count(session('cart')) > 0)
            <ul class="list-group list-group-flush" id="mini-cart-items">
                @php $totalPrice = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $totalPrice += $item['price'] * $item['quantity']; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $id }}">
                        <div>
                            {{ $item['name'] }} x {{ $item['quantity'] }}<br>
                            <small>KSh {{ number_format($item['price'] * $item['quantity'], 2) }}</small>
                        </div>
                        
                    </li>
                @endforeach
            </ul>
            <div class="mt-2 text-center">
                <strong>Total: KSh <span id="mini-cart-total">{{ number_format($totalPrice,2) }}</span></strong>
            </div>
            <div class="mt-2 text-center">
                <a href="{{ route('cart.index') }}" class="btn btn-sm btn-warning me-1">View Cart</a>
                 <a href="#" class="btn btn-sm btn-primary">Checkout</a>
                <!--<a href="{{ route('checkout.index') }}" class="btn btn-sm btn-primary">Checkout</a>-->
            </div>
        @else
            <p class="text-center mb-0">Your cart is empty.</p>
        @endif
    </div>
</div>

<!-- Toasts and Modals -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
    <div id="cart-toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="cart-toast-body">Product added to cart!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="variantModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Choose Options</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <form id="variantForm"><div id="variantOptions"></div></form>
    </div>
    <div class="modal-footer">
      <button type="button" id="variantAddBtn" class="btn btn-primary">Add to Cart</button>
    </div>
  </div></div>
</div>

<div class="modal fade" id="duplicateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Item Already in Cart</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">This product is already in your cart. Do you want to increase the quantity?</div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      <button type="button" id="confirm-add" class="btn btn-success">Yes, Add More</button>
    </div>
  </div></div>
</div>

<div class="modal fade" id="continueModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Product Added!</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">The product has been added to your cart. What would you like to do next?</div>
    <div class="modal-footer justify-content-start">
      <button type="button" class="btn btn-dark btn-sm me-2" data-bs-dismiss="modal">Continue Shopping</button>
      <a href="{{ route('cart.index') }}" class="btn btn-warning btn-sm me-2">View Cart</a>
      <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-sm">Proceed to Checkout</a>
    </div>
  </div></div>
</div>

<style>
:root {--brand-red:#fe0000;--brand-yellow:#ffc600;--brand-black:#000;}
#floating-cart-wrapper {position: fixed; top:80px; right:20px; z-index:2000;}
#floating-cart {display:flex; align-items:center; gap:8px; padding:8px 16px; border-radius:50px; background:var(--brand-yellow); color:var(--brand-black); font-weight:bold; text-decoration:none; cursor:pointer;}
#floating-cart:hover {background:#ffdb4d;}
#cart-count {font-size:0.75rem; min-width:20px; min-height:20px; background-color:var(--brand-red); color:#fff; font-weight:bold; border-radius:50px; padding:2px 8px;}
#mini-cart {width:280px; position:absolute; top:50px; right:0; background:#fff; border-radius:8px; display:none; z-index:2100;}
#mini-cart ul {max-height:300px; overflow-y:auto;}
.remove-mini-item {padding:0 6px; line-height:1;}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    var toastEl = document.getElementById('cart-toast');
    var toast = new bootstrap.Toast(toastEl);

    function showToast(message, bg='bg-success'){
        $('#cart-toast').removeClass('bg-success bg-danger bg-warning').addClass(bg);
        $('#cart-toast-body').text(message);
        toast.show();
    }

    var pendingProductId = null;

    // Hover/focus fix: use wrapper instead of just button
    $('#floating-cart-wrapper').on('mouseenter', function() {
        $('#mini-cart').stop(true,true).slideDown(200);
    }).on('mouseleave', function() {
        $('#mini-cart').stop(true,true).slideUp(200);
    });

    $('.add-to-cart').on('click', function(){
        let productId = $(this).data('id');
        let hasVariants = $(this).data('has-variants');
        pendingProductId = productId;

        if(hasVariants==1){
            $.get('/product/'+productId+'/variants', function(response){
                if(response.variants && response.variants.length>0){
                    let html=''; 
                    response.variants.forEach(v=>{
                        html+=`<div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="variant_id[]" value="${v.id}" id="variant-${v.id}">
                                  <label class="form-check-label" for="variant-${v.id}">${v.weight}kg – KSh ${parseFloat(v.price).toFixed(2)}</label>
                               </div>`;
                    });
                    $('#variantOptions').html(html);
                    new bootstrap.Modal(document.getElementById('variantModal')).show();
                }else{ addToCart(productId,null); }
            }).fail(()=>showToast('Error checking variants!','bg-danger'));
        }else{ addToCart(productId,null); }
    });

    $('#variantAddBtn').on('click', function(){
        let selected=[];
        $('#variantForm input[name="variant_id[]"]:checked').each(function(){ selected.push($(this).val()); });
        if(selected.length==0){ showToast('Please select at least one option!','bg-warning'); return; }
        addToCart(pendingProductId, selected);
        bootstrap.Modal.getInstance(document.getElementById('variantModal')).hide();
    });

    function addToCart(productId, variants){
        $.post('/cart/add/'+productId,{_token:'{{ csrf_token() }}',variants:variants}, function(response){
            if(response.exists){ new bootstrap.Modal(document.getElementById('duplicateModal')).show(); }
            else{
                updateMiniCart(response.cart);
                showToast(response.message,'bg-success');
                new bootstrap.Modal(document.getElementById('continueModal')).show();
            }
        }).fail(()=>showToast('Something went wrong!','bg-danger'));
    }

    function updateMiniCart(cart){
        let totalQty=0, totalPrice=0, html='';
        $.each(cart,function(id,item){
            totalQty+=item.quantity;
            totalPrice+=item.price*item.quantity;
            html+=`<li class="list-group-item d-flex justify-content-between align-items-center" data-id="${id}">
                        <div>${item.name} x ${item.quantity}<br><small>KSh ${(item.price*item.quantity).toFixed(2)}</small></div>
                        <button class="btn btn-sm btn-danger remove-mini-item">&times;</button>
                   </li>`;
        });
        $('#cart-count').text(totalQty);
        if(totalQty>0){
            html=`<ul class="list-group list-group-flush">${html}</ul>
                  <div class="mt-2 text-center"><strong>Total: KSh <span id="mini-cart-total">${totalPrice.toFixed(2)}</span></strong></div>
                  <div class="mt-2 text-center"><a href="{{ route('cart.index') }}" class="btn btn-sm btn-warning me-1">View Cart</a>
                  <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-primary">Checkout</a></div>`;
        }else{ html='<p class="text-center mb-0">Your cart is empty.</p>'; }
        $('#mini-cart').html(html);
    }

    // Remove item from mini cart
    $(document).on('click','.remove-mini-item',function(){
        let li=$(this).closest('li');
        let id=li.data('id');
        $.post('/cart/remove/'+id,{_token:'{{ csrf_token() }}'}, function(response){
            updateMiniCart(response.cart);
            showToast('Item removed!','bg-success');
        }).fail(()=>showToast('Error removing item','bg-danger'));
    });

    // Confirm duplicate add
    $('#confirm-add').on('click', function(){
        if(!pendingProductId) return;
        $.post('/cart/add/'+pendingProductId,{_token:'{{ csrf_token() }}',force:true}, function(response){
            updateMiniCart(response.cart);
            showToast('Quantity updated!','bg-success');
            pendingProductId=null;
            bootstrap.Modal.getInstance(document.getElementById('duplicateModal')).hide();
            new bootstrap.Modal(document.getElementById('continueModal')).show();
        });
    });
});
</script>
@endsection
