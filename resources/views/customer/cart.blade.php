@extends('layouts.app')

@section('content')

<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>Review <span>Orders</span></h3>
			
			 <div class="services-breadcrumb">
					<div class="agile_inner_breadcrumb">

					   <ul class="w3_short">
							<li><a href="/">Home</a><i>|</i></li>
							<li>Cart</li>
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
                        <th style="width: 50%;">Product</th>

                        <th style="width: 15%;">Quantity</th>
                        <th class="text-center"  style="width: 15%;">Price</th>
                        <th class="text-center" style="width: 10%;">Subtotal</th>
                        <th style="width: 10%;"> </th>
                    </tr>
                </thead>
                <tbody>



	               @foreach ($cartitems as $item)
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
                                                        <h4 class="media-heading" style="padding-left: 5%;"><a href="#">{{ $item->product->name }}</a></h4>
                                                        <h5 class="media-heading" style="padding-left: 5%;"> by <a href="#">{{ $item->product->brand->name }}</a></h5>
                                                        
                                                        
                                                    </div>

                                                </div>
                                            </td>
                            
                                            <form action="/cart/refresh/{{$item->id}}" method="post" id="refresh">
                                
                                               <td class="col-md-1" style="text-align: center">
                                                <input type="number" min="0" name="quantity" class="form-control" id="exampleInputEmail1" value="{{ $item->quantity }}">
                                               </td>
                                               <td class="col-md-1 text-center">
                                                    <strong>
                                                        @if ($item->product->percent_off == 0)
                                                            {{ $item->product->price }}
                                                        @else
                                                            {{ $item->product->price - (($item->product->percent_off / 100) * $item->product->price) }}
                                                        @endif
                                                        
                                                    </strong>
                                                </td>
                                               <td class="col-md-1 text-center"><strong>{{ $item->subtotal }}</strong></td>
                                               <td class="col-md-1">
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-info">
                                                              <span class="glyphicon glyphicon-refresh"></span>
                                                            </button>   
                                                        
                                                    </div>
                                               </form>

                                                    <div class="col-md-6">
                                                        <form action="/cart/delete/{{$item->id}}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-block">
                                                                <span class="glyphicon glyphicon-trash"></span>
                                                            </button>   
                                                        </form>
                                                    </div>  
                                                </div>
                                                
                                               </td>
                                           </tr>
                   @endforeach
                    




                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>{{ $cart->total }}</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        
                        <td>
                            
                        </td>
                        <td>
                            <form action="/cart/checkout" method="get">
                                <button type="submit" class="btn btn-warning btn-block">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                </button>    
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    

@endsection

@push('scripts')
	
@endpush