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

<div class="new_arrivals_agile_w3ls_info"> 
    <div class="container">
        <h3 class="wthree_text_info"></h3>     
            <div id="horizontalTab">
                    <ul class="resp-tabs-list">
                        <li> Orders</li>
                        <li> Pending Payments</li>
                        <li> Return Request</li>
                        <li> Cancel Request</li>
                    </ul>
                <div class="resp-tabs-container">
                <!--/tab_one-->
                    <div class="tab1">
	                    
	                    <div class="banner_bottom_agile_info">
	                	    <div class="container">
	                			<div class="agile_ab_w3ls_info">
	                				 <div class="col-md-12 contact-form">
	                				 
	                				 	<h4 class="white-w3ls">Orders</h4>
	                				 	
	                				 	<table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Status</th>
                                                    <th>Payment Type</th>
                                                    <th>Submitted At</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{$order->id}}</td>
                                                        <td>{{$order->status}}</td>
                                                        <td>{{$order->purchase_type}}</td>
                                                        <td>{{$order->created_at}}</td>
                                                        <td>
                                                            <a href="/transaction/manageorder/{{$order->id}}" class="btn btn-warning">Manage Order</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
	                				 		
	                				 	
	                				 </div>
	                				 <div class="clearfix"></div>
	                			</div>    
	                		 </div> 
	                    </div>
                    
                  	<div class="clearfix"></div>
                    </div>
                    <!--//tab_one-->

                    <!--/tab_two-->
                  	<div class="tab2">
                         
                             <div class="banner_bottom_agile_info">
                         	    <div class="container">
                         			<div class="agile_ab_w3ls_info">
                         				 <div class="col-md-12 contact-form">
                         				 
                         				 	<h4 class="white-w3ls">Pending <span>Payments</span></h4>
                         				 	
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Status</th>
                                                        <th>Shipping Fee</th>
                                                        <th>Total</th>
                                                        <th>Payment Type</th>
                                                        <th>Submitted At</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pendingorders as $order)
                                                        <tr>
                                                            <td>{{$order->id}}</td>
                                                            <td>{{$order->status}}</td>
                                                            <td>{{$order->shipping_fee}}</td>
                                                            <td>{{$order->total}}</td>
                                                            <td>{{$order->purchase_type}}</td>
                                                            <td>{{$order->created_at}}</td>
                                                            <td>
                                                                <a href="#" data-toggle="modal" data-target="#upload{{$order->id}}"  class="btn btn-warning"> Upload Receipt </a>
                                                                {{-- <a href="/transaction/uploadreceipt/{{$order->id}}" class="btn btn-warning">Upload Receipt</a> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>	
                         				 	
                         				 	
                         				 </div>
                         				 <div class="clearfix"></div>
                         			</div>    
                         		 </div> 
                             </div>  
                           
                  	<div class="clearfix"></div>
                   	</div>
                    <!--//tab_two-->

                    {{-- table_three --}}
                  	<div class="tab3">
                        
                            <div class="banner_bottom_agile_info">
                        	    <div class="container">
                        			<div class="agile_ab_w3ls_info">
                        				 <div class="col-md-12 contact-form">
                        				 
                        				 	<h4 class="white-w3ls">Return Product <span>Request</span></h4>
                                            
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order Item ID</th>
                                                        <th>Reason</th>
                                                        <th>Date Submitted</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rpr as $r)
                                                        <tr>
                                                            <td>{{$r->id}}</td>
                                                            <td>{{$r->reason}}</td>
                                                            <td>{{$r->created_at}}</td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>    	
                        				 	
                        				 </div>
                        				 <div class="clearfix"></div>
                        			</div>    
                        		 </div> 
                            </div>    
                    	  
                  	<div class="clearfix"></div>
                  	</div>

                    {{-- tab_four --}}
                 	 <div class="tab4">
                            
                            <div class="banner_bottom_agile_info">
                                <div class="container">
                                    <div class="agile_ab_w3ls_info">
                                         <div class="col-md-12 contact-form">
                                         
                                            <h4 class="white-w3ls">Cancel Product <span>Request</span></h4>
                                            
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order Item ID</th>
                                                        <th>Reason</th>
                                                        <th>Date Submitted</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cpr as $r)
                                                        <tr>
                                                            <td>{{$r->id}}</td>
                                                            <td>{{$r->reason}}</td>
                                                            <td>{{$r->created_at}}</td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>    
                                            
                                                
                                            
                                         </div>
                                         <div class="clearfix"></div>
                                    </div>    
                                 </div> 
                            </div>
                            
                  	<div class="clearfix"></div>
                 	</div>


                </div>
            </div>  
        </div>
    </div>


    


@foreach ($pendingorders as $order)
    <div class="modal fade" id="upload{{$order->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body modal-body-sub_agile">
                    <div class="col-md-12 modal_body_left modal_body_left1">
                    <h3 class="agileinfo_sign">Upload <span>Receipt</span></h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderitem as $item)
                                <tr>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->subtotal}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                     <form action="/transaction/uploadreceipt/{{$order->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Order ID</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" readonly value="{{$order->id}}">
                            </div>
                          </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Shipping Fee</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" readonly value="{{$order->shipping_fee}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Total</label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" readonly value="{{$order->total}}">
                            </div>
                          </div>
                        
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-default">
                                    Upload Receipt <input type="file" name="receipt" style="display: none;">
                                </span>
                            </label>
                            <input style="text-align: center;" type="text" class="form-control" readonly>
                        </div>
                        

                        <input type="submit" value="Upload" class="pull-right">
                    
                    </form>
                    
                    <div class="clearfix"></div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- //Modal content-->
        </div>
    </div>
@endforeach

@foreach ($orders as $order)
    <div class="modal fade" id="cancelrequest{{$order->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body modal-body-sub_agile">
                    <div class="col-md-12 modal_body_left modal_body_left1">
                    <h3 class="agileinfo_sign">Cancel <span>Request</span></h3>
                    
                    
                     <form action="/transaction/cancelrequest/{{$order->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Order ID</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" readonly value="{{str_pad($order->id, 10, '0', STR_PAD_LEFT)}}">
                            </div>
                          </div>

                          <div class="form-group">
                              <div class="col-sm-12">
                                <textarea class="form-control" rows="5" placeholder="Reason For Cancellation ...." name="reason"></textarea>
                              </div>
                            </div>

                        
                        
                        
                        

                        <input type="submit" value="Submit" class="pull-right">
                    
                    </form>
                    <div class="clearfix"></div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- //Modal content-->
        </div>
    </div>
@endforeach




@endsection

@push('scripts')
	
@endpush