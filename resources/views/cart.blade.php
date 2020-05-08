@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="#">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shopping Cart</span>
    @endcomponent
	<!-- end breadcrumbs -->
	
	@if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Cart::count() > 0)

    <section class="ftco-section ftco-cart">
        
			<div class="container">
				<div class="row">
				
    			<div class="col-md-12 ftco-animate">
				
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
								<th>&nbsp;</th>
						        <th><h4>{{ Cart::count() }} item(s) in Shopping Cart</h4></th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						      </tr>
							</thead>
							@foreach (Cart::content() as $item)
						    <tbody>
						      <tr class="text-center">
								<td class="product-remove">
								<form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

								<button type="submit" class="btn btn-primary py-3 px-4">X</button>
								</form>

								<hr>

								<form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-light py-3 px-4"><span><i class="ion-ios-heart">Wishlist</i></span></button>
                            	</form>
								</td>
						        
                                <td class="image-prod">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="img"></a>
                                </td>
						        
						        <td class="product-name">
						        	<h3>{{ $item->model->name }}</h3>
						        	<p>{{ $item->model->details }}</p>
						        </td>
						        
						        <td class="price">{{ presentPrice($item->subtotal) }}</td>
						        
						        <td class="quantity">
									<select class="quantity" data-id="{{ $item->rowId }}">
										@for ($i = 1; $i < 5 + 1 ; $i++)
										<option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
										@endfor
									</select>
					          </td>
						      </tr><!-- END TR-->
							</tbody>
							@endforeach
						  </table>
					  </div>
					  

    			</div>
            </div>
    		<div class="row justify-content-end">
    			<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						<span>{{ presentPrice(Cart::subtotal()) }}</span>
    					</p>
    					<p class="d-flex">
    						<span>TAX (14 %)</span>
    						<span>{{ presentPrice(Cart::tax()) }}</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span>{{ presentPrice(Cart::total()) }}</span>
    					</p>
    				</div>
					<p><a href="{{ route('checkout.index') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
					<p><a href="{{ route('shop.index') }}" class="btn btn-primary py-3 px-4">Continue Shopping</a></p>
    			</div>
    		</div>
			</div>

			@else
				<div style="text-align: center">
					<h3>No Items in cart</h3>
					<a href="{{ route('shop.index') }}" class="btn btn-primary py-3 px-4">Continue Shopping</a>
				</div>
            @endif
		</section>

		@if(Cart::count() > 0)
			@include('partials.might-like')
		@else
			<br>
			<br>
			<br>
			<br>
		@endif
		


@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value
                    })
                    .then(function (response) {
                        //console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>

@endsection