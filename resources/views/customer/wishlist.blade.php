@extends('layouts.app')

@section('content')

<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Wish<span>list</span></h3>
			
			 <div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">

					   <ul class="w3_short">
							<li><a href="/">Home</a><i>|</i></li>
							<li>Wishlist</li>
						</ul>
					 </div>
			</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 80%;">Product</th>

                        <th style="width: 10%;"></th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>



	               @foreach ($wishlist as $item)
                               <tr>
                                   <td class="col-md-6">
                                        <div class="media">
                                            
                                            @foreach ($item->product->productimage as $key => $image)
                                                @if ($key == 0)
                                                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ asset('images/productimages/' . $image->name) }}" style="width: 72px; height: 72px;"> 
                                                    </a>        
                                                @endif
                                            @endforeach
                                            
                                            
                                            <div class="media-body">
                                                <h4 class="media-heading" style="padding-left: 5%;">
                                                    <a href="#">{{ $item->product->name }}</a>
                                                </h4>
                                                
                                                <h5 class="media-heading" style="padding-left: 5%;"> by 
                                                    <a href="#">{{ $item->product->brand->name }}</a>
                                                </h5>
                                                
                                                
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <form method="post" action="/cart/addtocart/{{$item->product_id}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-warning">
                                                ADD TO CART
                                            </button>
                                        </form>
                                    </td>
                            
                                    <td>
                                        <form method="post" action="/wishlist/removewishlist/{{$item->id}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger">
                                                REMOVE
                                            </button>
                                        </form>
                                    </td>
                                            

                                                    
                                                
                                    </tr>
                   @endforeach
                    




                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
    

@endsection

@push('scripts')
	
@endpush