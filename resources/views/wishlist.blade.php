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
    
    <div class="hero-wrap hero-bread" style="background-image: url('/img/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
            <h1 class="mb-0 bread">My Wishlist</h1>
          </div>
        </div>
      </div>
    </div>

    @if(Cart::instance('saveForLater')->count() > 0)
    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
                @foreach (Cart::instance('saveForLater')->content() as $item)
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
                    <th>&nbsp;</th>
						        <th><h4>{{ Cart::instance('saveForLater')->count() }} item(s) In wishlist</h4></th>
						        <th>Product name</th>
						        <th>Price</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr class="text-center">
						        <td class="product-remove">
                                    <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-primary py-3 px-4">Remove</button>
                                    </form>

                                    <br>

                                    <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-primary py-3 px-4">Move to cart</button>
                                    </form>
                                </td>
						        
						        <td class="image-prod">
                                    <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="img"></a>
                                </td>
						        
						        <td class="product-name">
						        	<h3>{{ $item->model->name }}</h3>
						        	<p>{{ $item->model->details }}</p>
						        </td>
						        
                                <td class="price">{{ $item->model->presentPrice() }}</td>
                                
						      </tr><!-- END TR-->

						    </tbody>
						  </table>
					  </div>
                </div>
                @endforeach
    		</div>
            </div>
            
            @else
                <div style="text-align: center">
					<h3>No Items in Wishlist</h3>
					<a href="{{ route('shop.index') }}" class="btn btn-primary py-3 px-4">Continue Shopping</a>
				</div>
            @endif
		</section>


		@if(Cart::instance('saveForLater')->count() > 0)
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