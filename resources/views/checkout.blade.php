@extends('layout')

@section('title', 'Checkout')

@section('extra-css')

<script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url('/img/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
      @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
						<form action="{{ route('checkout.store') }}" method="POST" id="payment-form" class="billing-form">
                        {{ csrf_field()}}
							<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
                        <label for="email">Email Address</label>
                        @if (auth()->user())
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                        @else
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @endif
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
	                </div>
                </div>
                <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
		            	</div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	    <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
	                </div>
                    </div>
                    <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
	                </div>
                    </div>
                    <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
                        <label for="postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	    <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
	                    </div>
                    </div>
                    <div class="col-md-6">
		            	<div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
	                    </div>
		            </div>
		            
                </div>

                <br>
                
                <button type="submit" class="btn btn-primary py-3 px-4" id="complete-order">Complete Order</button>
	          </form><!-- END -->
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
                          <h3 class="billing-heading mb-4">Cart Total</h3>
                          @foreach (Cart::content() as $item)
	          			        <p class="d-flex">
		    						<span>Name</span>
		    						<span>{{ $item->model->name }}</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Details</span>
		    						<span>{{ $item->model->details }}</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Price</span>
		    						<span>{{ $item->model->presentPrice() }}</span>
		    					</p>
		    					<p class="d-flex total-price">
		    						<span>Qty</span>
		    						<span>{{ $item->qty }}</span>
                                </p>
                                <hr>
                                @endforeach
								</div>
	          	</div>
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Payment Method</h3>
                        <p class="d-flex">
		    				<span>Subtotal</span>
		    				<span>{{ presentPrice(Cart::subtotal()) }}</span>
                        </p>
                        @if (session()->has('coupon'))
                        <p class="d-flex">
		    				<span>
                                Discount ({{ session()->get('coupon')['name'] }}) :
                            </span>
                            <span>
                                -{{ presentPrice($discount) }}
                                <form action="{{ route('coupon.destroy') }}" method="POST" style="display: inline">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" style="font-size: 14px">Remove</button>
                                </form>
                            </span>
                        </p>
                        <p class="d-flex">
                            <span>New Subtotal</span>
		    				<span>{{ presentPrice($newSubtotal) }}</span>
                        </p>
                        @endif
                        <p class="d-flex">
		    				<span>Tax (14%)</span>
		    				<span>{{ presentPrice($newTax) }}</span>
                        </p>
                        <p class="d-flex">
		    				<span>Total</span>
		    				<span>{{ presentPrice($newTotal) }}</span>
                        </p>			
					</div>
	          	</div>
              </div>
              
              @if (!session()->has('coupon'))
                    <a href="#" class="have-code">Have a Code?</a>

                    <div class="have-code-container">
                        <form action="{{ route('coupon.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="coupon_code" id="coupon_code">
                            <button type="submit" class="button button-plain">Apply</button>
                        </form>
                    </div> <!-- end have-code-container -->
                @endif
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

@endsection

@section('extra-js')
<script>
    (function(){
        // Create a Stripe client.
        var stripe = Stripe('pk_test_u8T6VPCJhRZMvJT8ndnuZlwi00ugkJg106');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent repeated clicks
        document.getElementById('complete-order').disabled = true;

        var options = {
            name: document.getElementById('name_on_card').value,
            address_line1: document.getElementById('address').value,
            address_city: document.getElementById('city').value,
            address_state: document.getElementById('province').value,
            address_zip: document.getElementById('postalcode').value
        }

        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            // Enable the submit button
            document.getElementById('complete-order').disabled = false;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
    })();
</script>
@endsection
