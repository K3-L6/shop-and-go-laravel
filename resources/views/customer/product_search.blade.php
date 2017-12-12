@extends('layouts.app')

@section('content')
{{-- header --}}
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>{{ ucwords($category) }}</h3>
			
			 <div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">

					   <ul class="w3_short">
							<li><a href="/">Home</a><i>|</i></li>
							<li>Search</li>
						</ul>
					 </div>
			</div>
	</div>
</div>

	<div class="banner-bootom-w3-agileits">
	<div class="container">
         <!-- mens -->
		
		<div class="col-md-10  col-md-offset-1 products-right">	
			
			@foreach ($products as $item)
			    <div class="col-md-4 product-men">
			        <div class="men-pro-item simpleCart_shelfItem">
			            <div class="men-thumb-item">
			                @foreach ($item->productimage as $key => $image)
			                    @if ($key == 0)
			                        <img src="{{ asset('images/productimages/' . $image->name) }}" alt="" class="pro-image-front" height="250px">
			                        <img src="{{ asset('images/productimages/' . $image->name) }}" alt="" class="pro-image-back" height="250px">
			                    @else

			                    @endif
			                @endforeach
			                
			                    <div class="men-cart-pro">
			                        <div class="inner-men-cart-pro" >
			                            <a href="/product/single/{{$item->id}}" class="link-product-add-cart" >Quick View</a>
			                        </div>
			                    </div>

			                    @if ($item->percent_off != 0)
			                        <span class="product-new-top">On Sale {{ $item->percent_off }}% Off</span>
			                    @endif
			                    
			                    
			            </div>
			            <div class="item-info-product ">
			                <h4><a href="/product/single/{{$item->id}}">{{ $item->name }}</a></h4>
			                <div class="info-product-price">
			                    @if ($item->percent_off == 0)
			                        {{-- not on sale --}}
			                        <span class="item_price">₱ {{ $item->price }}</span>
			                    @else
			                        {{-- on sale --}}
			                        <span class="item_price">₱{{ $item->price - (($item->percent_off / 100) * $item->price) }}</span>
			                        <del>₱{{ $item->price }}</del>
			                    @endif
			                    
			                </div>
			                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2" style="width:55%;">
			                    <form action="/cart/addtocart/{{$item->id}}" method="post">
			                        {{csrf_field()}}
			                        <input type="submit" name="submit" value="Add To Cart" class="button" />  
			                    </form>
			                </div>
			                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2" style="width:15%;">
			                    <form action="/wishlist/addtowishlist/{{$item->id}}" method="post">
			                    	{{csrf_field()}}
			                        <input type="submit" name="submit" value="&#xf08a;" class="fa button" style="height: 31px;" />
			                    </form>
			                </div>                              
			            </div>
			        </div>
			    </div>
			@endforeach


					
			<div class="clearfix"></div>
		</div>
		
		
		

		<div class="clearfix"></div>
	</div>
</div>	




@endsection

@push('scripts')
	
@endpush