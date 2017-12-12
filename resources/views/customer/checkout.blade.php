@extends('layouts.app')

@section('content')

<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Check <span>Out</span></h3>
			
			 <div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">

					   <ul class="w3_short">
							<li><a href="/">Home</a><i>|</i></li>
							<li><a href="/cart">Cart</a><i>|</i></li>
							<li>Checkout</li>
						</ul>
					 </div>
			</div>
	</div>
</div>

<div class="container wrapper" style="padding-top:3%;">
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="/cart/checkout/payment">
                {{ csrf_field() }}
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                   
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
                            
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>P</span><span>{{ $cart->total }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Shipping Address</div>
                        <div class="panel-body">
                            

                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>First Name:</strong>
                                    <input type="text" name="firstname" class="form-control" value="@if(Auth::user()){{Auth::user()->firstname}}@endif" />
                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Last Name:</strong>
                                    <input type="text" name="lastname" class="form-control" value="@if(Auth::user()){{Auth::user()->lastname}}@endif" />
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Address:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control address" value="@if(Auth::user()){{Auth::user()->address}}@endif" />
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        	<div class="form-group">
                        	    <div class="col-md-12"><strong>Province:</strong></div>
                        	    <div class="col-md-12">
                        	    	{{Form::select('province', App\Province::pluck('name', 'id'), Auth::user()->province_id,['class' => 'form-control province', 'placeholder' => 'Select Province',  'style' => 'height:35px !important;'])}}
                        	    	@if ($errors->has('province'))
                        	    	    <span class="help-block">
                        	    	        <strong>{{ $errors->first('province') }}</strong>
                        	    	    </span>
                        	    	@endif
                        	    </div>
                        	</div>
                        
                            <div class="form-group">
                                <div class="col-md-12"><strong>Mobile Number:</strong></div>
                                <div class="col-md-12"><input type="text" name="mobilenumber" class="form-control" value="@if(Auth::user()){{Auth::user()->mobilenumber}}@endif" />
	                                @if ($errors->has('mobilenumber'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('mobilenumber') }}</strong>
	                                    </span>
	                                @endif
                                </div>
                            </div>
                            
                            {{-- hide email if loged in show if guest --}}
                            @if (Auth::user())
                                <div class="form-group">
                                    <div class="col-md-12"><input type="hidden" name="email" class="form-control" value="@if(Auth::user()){{Auth::user()->email}}@endif" />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    </div>
                                </div>

                            @else
                                <div class="form-group">
                                    <div class="col-md-12"><strong>Email Address:</strong></div>
                                    <div class="col-md-12"><input type="text" name="email" class="form-control" value="@if(Auth::user()){{Auth::user()->email}}@endif" />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    </div>
                                </div>
                            @endif
                            

                           	<input type="submit" value="Continue" class="btn btn-warning btn-block" style="margin-bottom: 0px;" >
                           
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
            
                </div>
                
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
    $(document).ready(function (argument) {
        $(document).on('change', '.province', function(){
            var prov_id = $(this).val();
            var op = " ";
            var div = $(this).parents();
            $.ajax({
                type:'get',
                url:'{!! URL::to('findCities') !!}',
                data:{'id':prov_id},
                success:function(data){
                    op += '<option value = "0">Select City</option>';
                    for(var i = 0; i < data.length; i++)
                    {
                        op += '<option value ="' + data[i].id + '">' + data[i].name + '</option>'
                    }
                    div.find('.city').html(" ");
                    div.find('.city').append(op);
                },
                error:function(){
                    
                }
            });
        });
    });
</script>
@endpush