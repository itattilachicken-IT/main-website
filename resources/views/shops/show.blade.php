@extends('layouts.app')

@section('title', 'Attila Chicken - ' . $product->name)

@section('content')
<div class="container">
    <div class="row">
        {{-- Product Image --}}
        <div class="col-md-6">
            <img src="{{ $product->image_url }}" 
                 class="img-fluid mb-3" 
                 alt="Attila {{ $product->name }}" 
                 data-bs-toggle="modal" 
                 data-bs-target="#imageModal">
        </div>

        {{-- Product Details --}}
        <div class="col-md-6">
            <h1>Attila {{ $product->name }}</h1>

            {{-- Description --}}
            <div class="mb-3 product-description">
                @php
                    $lines = preg_split('/\r\n|\r|\n/', $product->description);
                    $html = '';
                    $inBullet = false;
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line === '') { 
                            if ($inBullet) { $html .= '</ul>'; $inBullet=false; } continue; 
                        }
                        if (preg_match('/^Why You’ll Love/i', $line)) {
                            if($inBullet) $html .= '</ul>';
                            $html .= '<p><strong>' . e($line) . '</strong></p>';
                            $html .= '<ul style="list-style-type: disc; padding-left: 1.5rem;">';
                            $inBullet=true; continue;
                        }
                        $html .= $inBullet ? '<li>'.e($line).'</li>' : '<p>'.e($line).'</p>';
                    }
                    if($inBullet) $html .= '</ul>';
                @endphp
                {!! $html !!}
            </div>
            
            

            {{-- Price / Variants --}}
            @if($product->variants->count() > 0)
                <h4>Available Variants</h4>
                <ul>
                    @foreach($product->variants as $variant)
                        <li>{{ $variant->weight }}kg — KSh {{ number_format($variant->price, 2) }}</li>
                    @endforeach
                </ul>
            @else
                <p><strong>KSh {{ number_format($product->price_per_kg,2) }}/kg</strong></p>
            @endif

            {{-- Add to Cart Button --}}
            <button type="button"
                    class="btn btn-danger fw-bold mt-2 add-to-cart"
                    data-id="{{ $product->id }}"
                    data-has-variants="{{ $product->variants->count() > 0 ? '1' : '0' }}">
                Add to Cart
            </button>
 </div>
            {{-- SEO / Microcopy below button (small full width) --}}
            <small class="text-muted d-block w-100 mt-2">
                Order <strong>Attila {{ $product->name }}</strong> online in Nairobi and Thika. We deliver to key areas including Westlands, Kilimani, Parklands, Kileleshwa, Lavington, Spring Valley, Gigiri, Rosslyn, Eastleigh, Donholm, Buruburu, Umoja, Kayole, Dandora, Kariobangi, Nairobi CBD, Pangani, South B, South C, Syokimau, Karen, Langâ€™ata, Rongai, Dagoretti, Riruta, Roysambu, Zimmerman, Githurai, Kahawa, Kasarani, Ruai, Embakasi, as well as Thika Town, Juja Road, Gatanga, Kamenu, Kenyatta Estate, Thika Greens, Maragua, Chania, Muthaiga, Kakuzi, and surrounding neighborhoods. Enjoy fresh, high-quality Attila chicken delivered straight to your doorstep.
            </small>
       
    </div>
</div>

{{-- Modals --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content"><div class="modal-body p-0">
        <img src="{{ $product->image_url }}" class="img-fluid" alt="Attila {{ $product->name }}">
    </div></div>
  </div>
</div>

<div class="modal fade" id="variantModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Choose Variant</h5>
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
    <div class="modal-header">
        <h5 class="modal-title">Item Already in Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">This product is already in your cart. Do you want to increase the quantity?</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="confirm-add" class="btn btn-success">Yes, Add More</button>
    </div>
  </div></div>
</div>

<div class="modal fade" id="continueModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Product Added!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">The product has been added to your cart. What would you like to do next?</div>
    <div class="modal-footer justify-content-start">
        <button type="button" class="btn btn-dark btn-sm me-2" data-bs-dismiss="modal">Continue Shopping</button>
        <a href="{{ route('cart.index') }}" class="btn btn-warning btn-sm me-2">View Cart</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-sm">Proceed to Checkout</a>
    </div>
  </div></div>
</div>

{{-- Floating Cart & Mini Dropdown --}}
<div id="floating-cart-wrapper" style="position:fixed; top:80px; right:20px; z-index:2000;">
    <a href="javascript:void(0)" id="floating-cart" class="d-flex align-items-center justify-content-center rounded-circle shadow-lg" style="background:#ffc600; padding:8px 16px; font-weight:bold; color:#000;">
        <span class="cart-icon">🛒</span>
        <span id="cart-count" class="badge rounded-circle position-absolute top-0 start-100 translate-middle">
            {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
        </span>
    </a>

    {{-- Mini Cart Dropdown --}}
    <div id="mini-cart" class="shadow p-2 bg-white rounded" style="display:none; width:280px; position:absolute; top:50px; right:0; z-index:2100;">
        @if(session('cart') && count(session('cart'))>0)
            <ul class="list-group list-group-flush" id="mini-cart-items">
                @php $totalPrice=0; @endphp
                @foreach(session('cart') as $id=>$item)
                    @php $totalPrice += $item['price']*$item['quantity']; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $id }}">
                        <div>{{ $item['name'] }} x {{ $item['quantity'] }}<br><small>KSh {{ number_format($item['price']*$item['quantity'],2) }}</small></div>
                        <button class="btn btn-sm btn-danger remove-mini-item">&times;</button>
                    </li>
                @endforeach
            </ul>
            <div class="mt-2 text-center"><strong>Total: KSh <span id="mini-cart-total">{{ number_format($totalPrice,2) }}</span></strong></div>
            <div class="mt-2 text-center">
                <a href="{{ route('cart.index') }}" class="btn btn-sm btn-warning me-1">View Cart</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-primary">Checkout</a>
            </div>
        @else
            <p class="text-center mb-0">Your cart is empty.</p>
        @endif
    </div>
</div>

{{-- Toast --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:1080">
    <div id="cart-toast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body" id="cart-toast-body">Product added!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    var toast = new bootstrap.Toast(document.getElementById('cart-toast'));
    function showToast(message,bg='bg-success'){ $('#cart-toast').removeClass('bg-success bg-danger bg-warning').addClass(bg); $('#cart-toast-body').text(message); toast.show(); }

    let pendingProductId=null;

    // Floating mini-cart hover
    $('#floating-cart-wrapper').hover(
        ()=>$('#mini-cart').stop(true,true).slideDown(200),
        ()=>$('#mini-cart').stop(true,true).slideUp(200)
    );

    // Add to Cart button
    $('.add-to-cart').on('click',function(){
        let productId=$(this).data('id');
        let hasVariants=$(this).data('has-variants');
        pendingProductId=productId;

        if(hasVariants==1){
            $.get('{{ route("products.variants", ":id") }}'.replace(':id',productId),function(response){
                if(response.variants && response.variants.length>0){
                    let html='';
                    response.variants.forEach(v=>{
                        html+=`<div class="form-check">
                                  <input class="form-check-input" type="radio" name="variant_id[]" value="${v.id}" id="variant-${v.id}">
                                  <label class="form-check-label" for="variant-${v.id}">${v.weight}kg – KSh ${parseFloat(v.price).toFixed(2)}</label>
                               </div>`;
                    });
                    $('#variantOptions').html(html);
                    new bootstrap.Modal(document.getElementById('variantModal')).show();
                } else addToCart(productId,null);
            }).fail(()=>showToast('Error fetching variants','bg-danger'));
        } else addToCart(productId,null);
    });

    $('#variantAddBtn').on('click',function(){
        let selected=[];
        $('#variantForm input[name="variant_id[]"]:checked').each(function(){ selected.push($(this).val()); });
        if(selected.length==0){ showToast('Please select a variant!','bg-warning'); return; }
        addToCart(pendingProductId,selected);
        bootstrap.Modal.getInstance(document.getElementById('variantModal')).hide();
    });

    function addToCart(productId,variants){
        $.post('/cart/add/'+productId,{_token:'{{ csrf_token() }}',variants:variants},function(response){
            if(response.exists){ new bootstrap.Modal(document.getElementById('duplicateModal')).show(); }
            else { updateMiniCart(response.cart); showToast(response.message,'bg-success'); new bootstrap.Modal(document.getElementById('continueModal')).show(); }
        }).fail(()=>showToast('Something went wrong!','bg-danger'));
    }

    $('#confirm-add').on('click',function(){
        if(!pendingProductId) return;
        $.post('/cart/add/'+pendingProductId,{_token:'{{ csrf_token() }}',force:true},function(response){
            updateMiniCart(response.cart); showToast('Quantity updated!','bg-success');
            pendingProductId=null; bootstrap.Modal.getInstance(document.getElementById('duplicateModal')).hide();
            new bootstrap.Modal(document.getElementById('continueModal')).show();
        });
    });

    // Mini cart update
    function updateMiniCart(cart){
        let totalQty=0,totalPrice=0,html='';
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
        } else html='<p class="text-center mb-0">Your cart is empty.</p>';
        $('#mini-cart').html(html);
    }

    // Remove item from mini cart
    $(document).on('click','.remove-mini-item',function(){
        let li=$(this).closest('li');
        let id=li.data('id');
        $.post('/cart/remove/'+id,{_token:'{{ csrf_token() }}'},function(response){ updateMiniCart(response.cart); showToast('Item removed!','bg-success'); })
        .fail(()=>showToast('Error removing item','bg-danger'));
    });
});
</script>
@endsection
