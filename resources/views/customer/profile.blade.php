@extends('layouts.app')

@section('content')

<div class="page-head_agile_info_w3l" style="padding: 0px;">
		<div class="clearfix">
			<img src="{{ asset('/images/avatars/' . Auth::user()->avatar) }}" alt=" " class="img-responsive"  style="height: 200px; float: left; width: 280px" />
			<h3 class="clearfix" style="transform: translateY(50%);">
				{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }} 
				<span>Profile </span>
			</h3>
			
	</div>
</div>

    


    <div class="banner_bottom_agile_info">
        <div class="container">


            <div class="row">
                <div class="col-md-7">         
                    <div class="agile_ab_w3ls_info">
                         <div class="col-md-12 contact-form">
                         
                            <h4 class="white-w3ls">Personal <span>Information</span></h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mail-agileits-w3layouts">
                                        <div class="contact-right">
                                            <p>Last Name </p><span style="color: white; font-size: 25px;">{{ Auth::user()->lastname }}</span>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>        
                                </div>
                                <div class="col-md-6">
                                    <div class="mail-agileits-w3layouts">
                                        <div class="contact-right">
                                            <p>First Name </p><span style="color: white; font-size: 25px;">{{ Auth::user()->firstname }}</span>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="mail-agileits-w3layouts">
                                    <div class="contact-right">
                                        <p>Email Address </p><span style="color: white; font-size: 25px;">{{ Auth::user()->email }}</span>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mail-agileits-w3layouts">
                                    <div class="contact-right">
                                        <p>Mobile Number </p><span style="color: white; font-size: 25px;">{{ Auth::user()->mobilenumber }}</span>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-6" style="padding-top: 10%;">
                                    <a href="#" data-toggle="modal" data-target="#changeinfo"  class="btn btn-warning btn-block"> Change Information </a>
                                    
                                </div>
                                <div class="col-md-6" style="padding-top: 10%;">
                                    <a href="#" data-toggle="modal" data-target="#changeinfo"  class="btn btn-warning btn-block"> Change Password </a>
                                </div>    
                            </div>
                            

                             
                            
                         </div>
                         <div class="clearfix"></div>
                    </div>                
                </div>

                <div class="col-md-5">         
                    <div class="agile_ab_w3ls_info">
                         <div class="col-md-12 contact-form">
                         
                            <h4 class="white-w3ls">My <span>Location</span></h4>
                            
                            <div class="mail-agileits-w3layouts">
                                <div class="contact-right">
                                    <p>Province </p><span style="color: white; font-size: 25px;">{{ Auth::user()->province->name }}</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>

                            


                            <div class="mail-agileits-w3layouts">
                                <div class="contact-right">
                                    <p>Address </p><span style="color: white; font-size: 25px;">{{Auth::user()->address}}</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>




                            <div class="col-md-6" style="padding-top: 10%;">
                                <form>
                                    <input type="submit" value="Change Address">
                                </form>
                            </div>

                            
                                
                            
                            

                         </div>
                         <div class="clearfix"></div>
                    </div>                
                </div>    
            </div>
            

    




         </div> 
    </div>


    <div class="modal fade" id="changeinfo" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body modal-body-sub_agile">
                    <div class="col-md-12 modal_body_left modal_body_left1">
                    <h3 class="agileinfo_sign">Change <span>Information</span></h3>

                    
                    
                     <form action="/user/changeinfo" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Last Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="lastname" class="form-control" value="{{Auth::user()->lastname}}">
                            </div>
                          </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">First Name</label>
                            <div class="col-sm-8">
                              <input type="text" name="firstname" class="form-control" value="{{Auth::user()->firstname}}">
                            </div>
                          </div>

                          

                          <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Mobile Nuber</label>
                            <div class="col-sm-8">
                              <input type="text" name="mobilenumber" class="form-control" value="{{Auth::user()->mobilenumber}}">
                            </div>
                          </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email">Email</label>
                            <div class="col-sm-8">
                              <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}">
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

@endsection

@push('scripts')
	
@endpush