@extends('layouts.app')

@section('content')

<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Payment <span>Options</span></h3>
			
			 <div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">

					   <ul class="w3_short">
							<li><a href="/">Home</a><i>|</i></li>
							<li><a href="/cart">Cart</a><i>|</i></li>
							<li><a href="/cart/checkout">Checkout</a><i>|</i></li>
							<li>Payment</li>
						</ul>
					 </div>
			</div>
	</div>
</div>


<div class="container wrapper" style="padding-top: 3%;">

            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="/cart/checkout/payment/postfinish">
				{{ csrf_field() }}
                <div class="col-md-7">
                    <!--CREDIT CART PAYMENT-->



					<div class="panel panel-info">
	                    <div class="panel-heading">Choose Payment Method</div>
	                    <div class="panel-body">
	                    	<div id="tab" class="btn-group btn-group-justified" data-toggle="buttons">
	                    	        <a href="#prices" class="btn btn-default active" data-toggle="tab">
	                    	          <input type="radio" name="paymenttype" value="cod" />
	                    	          <img src="{{ asset('images/codicon.png') }}" class="img-responsive" style="width: 35px; height: 35px; margin: 0 auto;">
	                    	          Cash On Delivery
	                    	        </a>
	                    	        <a href="#features" class="btn btn-default" data-toggle="tab">
	                    	          <input type="radio" name="paymenttype" value="moneytransfer" />
	                    	          <img src="{{ asset('images/moneytransfericon.png') }}" class="img-responsive" style="width: 35px; height: 35px; margin: 0 auto;">
	                    	          Money Transfer
	                    	        </a>
	                    	        {{-- <a href="#requests" class="btn btn-default" data-toggle="tab">
	                    	          <input type="radio" name="paymenttype" value="creditcart" />
	                    	          <img src="{{ asset('images/creditcard.png') }}" class="img-responsive" style="width: 35px; height: 35px; margin: 0 auto;">
	                    	          2C2P Credit Card
	                    	        </a> --}}
	                    	        
	                    	        
	                    	      </div>

	                    	      <div class="tab-content">
	                    	        
	                    	        <div class="tab-pane active" id="prices">
	                    	        	<div style="margin: 3%;">
	                    	        		
	                    	        		<h3>Cash On Delivery</h3>
	                    	        		<br>
	                    	        		<p>
	                    	        			Full payment is done directly to the courier upon delivery. No partial down payments required.
	                    	        		</p>	
	
	                    	        	</div>
	                    	        	
	                    	        	<input type="submit" name="submit" value="Place Order" class="btn pull-right btn-warning">
	                    	        </div>

	                    	        <div class="tab-pane" id="features">
	                    	        	
	                    	        	<div style="margin: 3%;">

	                    	        		<h3>Pay Using Money Transfer</h3>
	                    	        		<br>
	                    	        		<p>
	                    	        			Choose a Money Transfer Provider and we will email you for instruction on how to pay. 
	                    	        		</p>
	                    	        		
                	        				<div class="form-group" style="padding-top: 3%;">
                	        				    <div class="col-md-12"><strong>Money Transfer:</strong></div>
                	        				    <div class="col-md-12">
                	        				    	{{Form::select('moneytransfers', App\Moneytransfer::pluck('name', 'id'), null,['class' => 'form-control', 'placeholder' => 'Select Provider',  'style' => 'height:35px !important;'])}}
                	        			    	    	@if ($errors->has('moneytransfers'))
                	        			    	    	    <span class="help-block">
                	        			    	    	        <strong>{{ $errors->first('moneytransfers') }}</strong>
                	        			    	    	    </span>
                	        			    	    	@endif
                	        			    	    
                	        				    </div>
                	        				</div>
	                    	        			
		                                	
	                    	        	</div>
                                    	
	                    	        	<input type="submit" name="submit" value="Place Order" class="btn pull-right btn-warning">
	                    	        </div>
	                    	        <div class="tab-pane" id="requests" >
	                    	        	<div style="margin: 3%;">
	                    	        		
	                    	        		<h3>Pay Using Credit Card via 2c2p</h3>
	                    	        		<br>
	                    	        		<p>
	                    	        			Pay Using 2c2p that simplifies e-commerce and m-commerce payments for merchants everyday.
	                    	        		</p>	


	   	                    	        			
	                    	        		</div>
	                    	        	<input type="submit" name="submit" value="Place Order" class="btn pull-right btn-warning">
	                    	        	
	                    	        </div>
	                    	      </div>
	                        
	                    </div>
	                </div>

                    <!--CREDIT CART PAYMENT END-->
                </div>


                <div class="col-md-5">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Reviewed Order
                        </div>
                        <div class="panel-body">
                        	@foreach ($cartitems as $key => $items)
                        		@if ($key == 0)
                        			<div class="form-group">
                        			    <div class="col-sm-3 col-xs-3">
                        			    	@foreach ($items->product->productimage as $key => $image)
                        			    		@if ($key == 0)
                        			    			<img src="{{ asset('images/productimages/' . $image->name) }}" alt="" class="img-responsive">
                        			    		@endif
                        			    	@endforeach
                        			        
                        			    </div>
                        			    <div class="col-sm-6 col-xs-6">
                        			        <div class="col-xs-12">{{ $items->product->name }}</div>
                        			        <div class="col-xs-12"><small>Quantity:<span> {{ $items->quantity }}</span></small></div>
                        			    </div>
                        			    <div class="col-sm-3 col-xs-3 text-right">
                        			        <h6><span>P</span>{{ $items->subtotal }}</h6>
                        			    </div>
                        			</div>
                        		@else
									<div class="form-group"><hr /></div>
									<div class="form-group">
									    <div class="col-sm-3 col-xs-3">
									    	@foreach ($items->product->productimage as $key => $image)
									    		@if ($key == 0)
									    			<img src="{{ asset('images/productimages/' . $image->name) }}" alt="" class="img-responsive">
									    		@endif
									    	@endforeach
									    </div>
									    <div class="col-sm-6 col-xs-6">
									        <div class="col-xs-12">{{ $items->product->name }}</div>
									        <div class="col-xs-12"><small>Quantity:<span> {{ $items->quantity }}</span></small></div>
									    </div>
									    <div class="col-sm-3 col-xs-3 text-right">
									        <h6><span>P</span>{{ $items->subtotal }}</h6>
									    </div>
									</div>
                        		@endif
                        	@endforeach

                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Subtotal</strong>
                                    <div class="pull-right"><span>P</span><span>{{ $cart->total }}</span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>P</span><span>
                                    	{{ $userinfo['shippingfee'] }}
                                    	<input type="hidden" name="shippingfee" value="{{ $userinfo['shippingfee'] }}">
                                    </span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>P</span><span>{{ $cart->total + $userinfo['shippingfee'] }}</span></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
					
					<div class="panel panel-info">
					    <div class="panel-heading">Shipping Address</div>
					    <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="firstname" class="form-control" value="{{$userinfo['firstname']}}" readonly />
                                    
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="lastname" class="form-control" value="{{$userinfo['lastname']}}" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="{{$userinfo['address']}}" readonly />
                                </div>
                            </div>
                        	<div class="form-group">
                        	    <div class="col-md-12"><strong>Province:</strong></div>
                        	    <div class="col-md-12">
                        	    	<input type="text" name="province" class="form-control" value="{{App\Province::find($userinfo['province'])['name']}}" readonly />
                        	    </div>
                        	</div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Mobile Number:</strong></div>
                                <div class="col-md-12">
                                	<input type="text" name="mobilenumber" class="form-control" value="{{$userinfo['mobilenumber']}}" readonly />
                                </div>
                            </div>

							@if (Auth::user())
								<div class="form-group">
								    <div class="col-md-12"><input type="hidden" name="email" class="form-control" value="{{$userinfo['email']}}" readonly="" />
								    </div>
								</div>
							@else
								<div class="form-group">
								    <div class="col-md-12"><strong>Email Address:</strong></div>
								    <div class="col-md-12"><input type="text" name="email" class="form-control" value="{{$userinfo['email']}}" readonly="" />
								    </div>
								</div>
							@endif

      					    </div>
					</div>

                </div>
                
                
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>

@endsection

@push('scripts')
@endpush