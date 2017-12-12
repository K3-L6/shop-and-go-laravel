@extends('layouts.app')

@section('content')

{{-- Product Showcase Group --}}
<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-inner" role="listbox">
            @foreach ($showcases as $key => $showcase)
                @if ($key == 0)
                    <div class="item active" style="background: url('{{ asset('images/showcasebanners/' . $showcase->banner) }}') no-repeat; background-size: 100% 100%;"> 
                        <div class="container">
                            <div class="carousel-caption">
                                <h3>{{ $showcase->name }}</h3>
                                <a class="hvr-outline-out button2" href="/product/showcase/{{$showcase->id}}">Shop Now </a>
                            </div>
                        </div>
                    </div>  
                @else
                    <div class="item item2" style="background: url('{{ asset('images/showcasebanners/' . $showcase->banner) }}') no-repeat; background-size: 100% 100%;"> 
                        <div class="container">
                            <div class="carousel-caption">
                                <h3>{{ $showcase->name }}</h3>
                                <a class="hvr-outline-out button2" href="/product/showcase/{{$showcase->id}}">Shop Now </a>
                            </div>
                        </div>
                    </div>
                @endif
        
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!-- The Modal -->
    </div> 





    {{-- Best Sellers --}}
    <div class="banner-bootom-w3-agileits">
        <div class="container">
            <h3 class="wthree_text_info">Best <span>Seller</span></h3>


            @foreach ($topseller as $key => $product)
              @if ($key == 0)
                <div class="col-md-5 bb-grids bb-left-agileits-w3layouts">
                    <a href="/product/single/{{$product->product_id}}">
                       <div class="bb-left-agileits-w3layouts-inner grid">
                            <figure class="effect-roxy">
                                    
                                        @foreach ($products as $item)
                                          @if ($item->id == $product->product_id)
                                            @foreach ($item->productimage as $key => $image)
                                               @if ($key == 0)
                                                 <img src="{{ asset('images/productimages/' . $image->name) }}" alt=" " class="img-responsive" / style="height: 613px;">
                                               @endif
                                             @endforeach 
                                          @endif
                                        @endforeach
                                      
                                    <figcaption>
                                        <h3>
                                          <span>
                                            @foreach ($products as $item)
                                              @if ($item->id == $product->product_id) 
                                                {{$item->name}}
                                              @endif
                                            @endforeach
                                          </span>
                                        </h3>
                                    </figcaption>           
                            </figure>
                        </div>
                    </a>
                </div>
              
              @elseif($key == 1)
              <div class="col-md-7 bb-grids bb-middle-agileits-w3layouts">
                <a href="/product/single/{{$product->product_id}}">
                 <div class="bb-middle-agileits-w3layouts grid">
                         <figure class="effect-roxy">
                              
                              @foreach ($products as $item)
                                @if ($item->id == $product->product_id)
                                  @foreach ($item->productimage as $key => $image)
                                     @if ($key == 0)
                                       <img src="{{ asset('images/productimages/' . $image->name) }}" alt=" " class="img-responsive" / style="height: 300px;">
                                     @endif
                                   @endforeach 
                                @endif
                              @endforeach


                              <figcaption>
                                  <h3>
                                    <span>
                                      @foreach ($products as $item)
                                        @if ($item->id == $product->product_id) 
                                          {{$item->name}}
                                        @endif
                                      @endforeach
                                    </span>
                                  </h3>
                                  
                              </figcaption>           
                          </figure>
                  </div>
                  </a>
                  <a href="/product/single/{{$product->product_id}}">
              @elseif($key == 2)
                      <div class="bb-middle-agileits-w3layouts forth grid">
                                <figure class="effect-roxy">

                                    @foreach ($products as $item)
                                      @if ($item->id == $product->product_id)
                                        @foreach ($item->productimage as $key => $image)
                                           @if ($key == 0)
                                             <img src="{{ asset('images/productimages/' . $image->name) }}" alt=" " class="img-responsive" / style="height: 300px;">
                                           @endif
                                         @endforeach 
                                      @endif
                                    @endforeach

                                    <figcaption>
                                        <h3>
                                          <span>
                                            @foreach ($products as $item)
                                              @if ($item->id == $product->product_id) 
                                                {{$item->name}}
                                              @endif
                                            @endforeach
                                          </span>
                                        </h3>
                                    </figcaption>       
                                </figure>
                            </div>
                            </a>
                    <div class="clearfix"></div>
                </div>
              @endif
            @endforeach

            
      



        </div>
    </div>


    {{-- New arrivals --}}
    <div class="new_arrivals_agile_w3ls_info"> 
        <div class="container">
            <h3 class="wthree_text_info">New <span>Arrivals</span></h3>     
                <div id="horizontalTab">
                        <ul class="resp-tabs-list">
                            <li> Headphones</li>
                            <li> Speakers</li>
                            <li> Digital Audio Players</li>
                            <li> Accessories</li>
                        </ul>
                    <div class="resp-tabs-container">
                    <!--/tab_one-->
                        <div class="tab1">
                            
                            @foreach ($newheadphones as $item)
                                <div class="col-md-3 product-men">
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
                        <!--//tab_one-->

                        <!--/tab_two-->
                           <div class="tab2">
                               
                               @foreach ($newspeakers as $item)
                                   <div class="col-md-3 product-men">
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
                                                           <a href="/product/single{{$item->id}}" class="link-product-add-cart" >Quick View</a>
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
                        <!--//tab_two-->

                        {{-- table_three --}}
                            <div class="tab3">
                                
                                @foreach ($newdap as $item)
                                    <div class="col-md-3 product-men">
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
                                                <h4><a href="/product/{{$item->id}}">{{ $item->name }}</a></h4>
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

                        {{-- tab_four --}}
                            <div class="tab4">
                                
                                @foreach ($newaccessories as $item)
                                    <div class="col-md-3 product-men">
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
                                                            <a href="/product/{{$item->id}}" class="link-product-add-cart" >Quick View</a>
                                                        </div>
                                                    </div>

                                                    @if ($item->percent_off != 0)
                                                        <span class="product-new-top">On Sale {{ $item->percent_off }}% Off</span>
                                                    @endif
                                                    
                                                    
                                            </div>
                                            <div class="item-info-product ">
                                                <h4><a href="/product/{{$item->id}}">{{ $item->name }}</a></h4>
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


                    </div>
                </div>  
            </div>
        </div>



@endsection