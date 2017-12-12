@extends('layouts.app')

@section('content')

<div class="page-head_agile_info_w3l" style="padding: 0px;">
		<div class="clearfix">
			<h3 class="clearfix" style="transform: translateY(50%); padding-top: 2.5%;">
				{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }} 
				<span>Transactions </span>
			</h3>
			
	</div>
</div>


<div class="banner_bottom_agile_info">
    <div class="container">
        <div class="agile_ab_w3ls_info">
             <div class="col-md-12 contact-form">
             
                <h4 class="white-w3ls">Orders Items</h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 35%;">Image</th>
                            <th style="width: 15%;">Order Item ID</th>
                            <th style="width: 15%;">Product Name</th>
                            <th style="width: 10%;">Price</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($orderitems as $item)
                            <tr>
                                <td>
                                    @foreach ($item->product->productimage as $key => $image)
                                        @if ($key == 1)
                                            <img src="{{ asset('images/productimages/' . $image->name) }}" style="height: 150px; width: 100%;">
                                            
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->product->name}}</td>
                                <td>{{$item->subtotal}}</td>
                                @if ($orderstatus == 'Order FulFilled')
                                    <td><a href="#" data-toggle="modal" data-target="#returnitem{{$item->id}}" class="btn btn-danger">Return Product Request</a></td>
                                @else
                                    <td><a href="#" data-toggle="modal" data-target="#cancelitem{{$item->id}}" class="btn btn-warning">Cancel Product Request</a></td>
                                @endif
                                
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                    
                
             </div>
             <div class="clearfix"></div>
        </div>    
     </div> 
</div>

<div class="banner_bottom_agile_info" style="padding-top: 0px !important;">
    <div class="container">
        <div class="agile_ab_w3ls_info">
             <div class="col-md-12 contact-form">
             
                <h4 class="white-w3ls">Transaction Activity</h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($ta as $activity)
                          <tr>
                            <td>{{$activity->message}}</td>
                            <td>{{$activity->created_at}}</td>
                          </tr>
                        @endforeach 
                    </tbody>
                </table>
                    
                
             </div>
             <div class="clearfix"></div>
        </div>    
     </div> 
</div>


<div class="container" style="padding-top: 0px !important;">
    <div class="row">

        <div class="col-md-6">
            <div class="agile_ab_w3ls_info">
                <div class="col-md-12 contact-form">
                     
                    <h4 class="white-w3ls">Shipping <span>Address</span></h4>

                        
                        
                    <div class="mail-agileits-w3layouts">
                        <div class="contact-right">
                            <p>Province </p><span style="color: white; font-size: 25px;">{{ Auth::user()->province->name }}</span>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div class="mail-agileits-w3layouts">
                        <div class="contact-right">
                            <p>Address </p><span style="color: white; font-size: 25px;">{{ Auth::user()->address }}</span>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                         
                        
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="agile_ab_w3ls_info">
                <div class="col-md-12 contact-form">
                     
                    <h4 class="white-w3ls">Billing <span>Information</span></h4>

                     <div class="mail-agileits-w3layouts">
                         <div class="contact-right">
                             <p>Shipping Fee </p><span style="color: white; font-size: 25px;">{{ $ordershippingfee }}</span>
                         </div>
                         <div class="clearfix"> </div>
                     </div>

                     <div class="mail-agileits-w3layouts">
                         <div class="contact-right">
                             <p>Total </p><span style="color: white; font-size: 25px;">{{ $ordertotal }}</span>
                         </div>
                         <div class="clearfix"> </div>
                     </div>   
                        

                         
                        
                </div>
                <div class="clearfix"></div>
            </div>
        </div>


    </div>    
</div>


    

@foreach ($orderitems as $item)
    {{-- create modal for return item --}}
@endforeach

@foreach ($orderitems as $item)
    <div id="cancelitem{{$item->id}}" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <h3 class="agileinfo_sign">Cancel Product <span>Request</span></h3>
             <form action="/transaction/cancelproductrequest/{{$item->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" readonly value="{{$item->product->name}}">
                    </div>
                  </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Order ID</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" readonly value="{{str_pad($item->order_id, 10, '0', STR_PAD_LEFT)}}">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Order Item ID</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" readonly value="{{str_pad($item->id, 10, '0', STR_PAD_LEFT)}}">
                      </div>
                    </div>

                  <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" rows="5" placeholder="Reason For Returning Items ...." name="reason"></textarea>
                      </div>
                    </div>

                <input type="submit" value="Submit" class="btn btn-block btn-danger">
            
            </form>
          </div>
          
        </div>

      </div>
    </div>
@endforeach

@foreach ($orderitems as $item)
    <div id="returnitem{{$item->id}}" class="modal fade" role="dialog">
      <div class="modal-dialog">
  
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <h3 class="agileinfo_sign">Return Product <span>Request</span></h3>
             <form action="/transaction/returnproductrequest/{{$item->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" readonly value="{{$item->product->name}}">
                    </div>
                  </div>

                  

                <div class="form-group">
                    <label class="control-label col-sm-4" for="email">Order ID</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" readonly value="{{str_pad($item->order_id, 10, '0', STR_PAD_LEFT)}}">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-sm-4" for="email">Order Item ID</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" readonly value="{{str_pad($item->id, 10, '0', STR_PAD_LEFT)}}">
                      </div>
                    </div>

                  <div class="form-group">
                      <div class="col-sm-12">
                        <textarea class="form-control" rows="5" placeholder="Reason For Returning Items ...." name="reason"></textarea>
                      </div>
                    </div>

                <input type="submit" value="Submit" class="btn btn-block btn-danger">
            
            </form>
          </div>
          
        </div>

      </div>
    </div>
@endforeach    







@endsection

@push('scripts')
	
@endpush