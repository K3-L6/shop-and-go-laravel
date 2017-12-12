@extends('layouts.app')

@section('content')
<div class="page-head_agile_info_w3l">
		<div class="container">
			
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short" style="padding-top:8%;">
								<li><a href="/">Home</a><i>|</i></li>
								<li>{{ $product->name }}</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>

     <div class="banner-bootom-w3-agileits">
	<div class="container">
	     <div class="col-md-7 single-right-left ">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					
					<ul class="slides">

						@foreach ($product->productimage as $key => $image)
							@if ($key == 0)
								<li data-thumb="{{ asset('images/productimages/' . $image->name) }}">
									<div class="thumb-image"> 
										<img style="height: 450px;" src="{{ asset('images/productimages/' . $image->name) }}" data-imagezoom="true" class="img-responsive"> 
									</div>
								</li>
							@elseif($key == 1)
								<li data-thumb="{{ asset('images/productimages/' . $image->name) }}">
									<div class="thumb-image"> 
										<img style="height: 450px;" src="{{ asset('images/productimages/' . $image->name) }}" data-imagezoom="true" class="img-responsive"> 
									</div>
								</li>
							@elseif($key == 2)
								<li data-thumb="{{ asset('images/productimages/' . $image->name) }}">
									<div class="thumb-image"> 
										<img style="height: 450px;" src="{{ asset('images/productimages/' . $image->name) }}" data-imagezoom="true" class="img-responsive"> 
									</div>
								</li>
							@endif
								
						@endforeach
						
						
						
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-4 single-right-left simpleCart_shelfItem">
					<h3>{{ $product->name }} by {{ $product->brand->name }}</h3>
					
					<p>
						@if ($product->percent_off == 0)
						    {{-- not on sale --}}
						    
						    <span class="item_price">₱ {{ $product->price }}</span>
						@else
						    {{-- on sale --}}
						    <span class="item_price">₱{{ $product->price - (($product->percent_off / 100) * $product->price) }}</span> 
						    <del>-₱{{ $product->price }} </del>
						   
						@endif
						
					</p>
					
					<div class="description">
						{!! $product->description !!}
					</div>
					
					
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2" style="width:100%; height: 35px;">
					    <form action="/cart/addtocart/{{$product->id}}" method="post">
					        {{csrf_field()}}
					        <input type="submit" name="submit" value="Add To Cart" class="button" />  
					    </form>
					</div>
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2" style="width:100%; height: 35px;">
					    <form action="/wishlist/addtowishlist/{{$product->id}}" method="post">
					        {{csrf_field()}}
					        <input type="submit" name="submit" value="Add To Wishlist" class="button" />  
					    </form>
					</div>
		      </div>
	 			<div class="clearfix"> </div>
				<!-- /new_arrivals --> 
	<div class="responsive_tabs_agileits"> 
				<div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li>Specification</li>
							<li>Reviews</li>
						</ul>
					<div class="resp-tabs-container">
					<!--/tab_one-->
					   <div class="tab1">

							<div class="single_page_agile_its_w3ls">
							  <table class="table">
							  	<thead>
							  		<tr>
							  			<th></th>
							  			<th></th>
							  		</tr>
							  	</thead>
							  	<tbody>
							  		@foreach ($product->productspecification as $item)
							  			<tr>
							  				<td>{{$item->name}}</td>
							  				<td>{{$item->value}}</td>
							  			</tr>
							  		@endforeach
							  	</tbody>
							  </table>
							</div>
						</div>
						<!--//tab_one-->
						
						   <div class="tab2">

							<div class="single_page_agile_its_w3ls">
							  	<div class="single_page_agile_its_w3ls">
							  		
							  		<div class="bootstrap-tab-text-grids">
							  			<div class="bootstrap-tab-text-grid">
							  				@foreach ($product->review as $review)
							  					<div style="padding-top:3%;">
							  						<div class="bootstrap-tab-text-grid-left">
							  							<img src="{{ asset('images/avatars/' . $review->user->avatar) }}" alt=" " class="img-responsive">
							  						</div>
							  						<div class="bootstrap-tab-text-grid-right">
							  							<ul>
							  								<li><a href="#">{{$review->user->firstname}} {{$review->user->lastname}}</a>
							  								</li>
							  							</ul>
							  							<p>{{$review->content}}</p>
							  						</div>
							  						<div class="clearfix"> </div>	
							  					</div>	
							  				@endforeach
							  				
							  				
							               </div>
							  			 
							  			 @if (Auth::user())
							  			 	 <div class="add-review">
							  			 		<h4>Add a review</h4>
							  			 		<form action="/review/{{$product->id}}" method="post">
							  			 				{{csrf_field()}}
							  			 				<input type="text" name="Name" required="Name" placeholder="{{Auth::user()->firstname}} {{Auth::user()->lastname}}" readonly>
							  			 				<input type="email" name="Email" required="Email" placeholder="{{Auth::user()->email}}" readonly> 
							  			 				<textarea name="content" required=""></textarea>
							  			 				
							  			 			<input type="submit" value="SEND">
							  			 		</form>
							  			 	</div>
							  			 @endif
							  			 

							  		 </div>
							  		 
							  	 </div>
							</div>

						</div>
					</div>
				</div>	
			</div>
	<!-- //new_arrivals --> 
	  	<!--/slider_owl-->
	
			
	        </div>
 </div>

@endsection

@push('scripts')
	
@endpush