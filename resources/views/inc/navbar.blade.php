<!-- header -->
<div class="header" id="home">
    <div class="container">
        <ul>
            @guest  
                <li> <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Sign In </a></li>
                <li> <a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sign Up </a></li>
                <li> <a href="/location"><i class="fa fa-map-marker" aria-hidden="true"></i> Location </a></li>
                <li> <a href="/aboutus"><i class="fa fa-info-circle" aria-hidden="true"></i> About US </a></li>
            @else
                <li> <a href="/profile"><i class="fa fa-user" aria-hidden="true"></i> My Account </a></li>
                <li> <a href="/wishlist"><i class="fa fa-paperclip" aria-hidden="true"></i> Wishlist </a></li>
                <li> <a href="/transaction"><i class="fa fa-money" aria-hidden="true"></i> Transactions </a></li>
                <li> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{-- <input type="submit" value="Transactions" style="margin-top: 10%; width: 100%;" class="btn btn-default pull-right"> --}}
                        <a href="javascript:{}" onclick="document.getElementById('logout-form').submit(); return false;">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout 
                        </a>
                    </form>
                </li>
            @endif
            
        </ul>
    </div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
    <div class="header-bot_inner_wthreeinfo_header_mid">
        <div class="col-md-4 header-middle">
            <form action="/product/search" method="post">
                    {{csrf_field()}}
                    <input type="search" name="search" placeholder="Search here..." required="">
                    <input type="submit" value=" ">
                <div class="clearfix"></div>
            </form>
        </div>
        <!-- header-bot -->
            <div class="col-md-4 logo_agile">
                <a href="/"><img src="{{ asset('images/logo.png') }}" width="350px" height="80px"></a>
            </div>
        <!-- header-bot -->
        <div class="col-md-4 agileits-social top_content">
                        



        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //header-bot -->
<!-- banner -->
<div class="ban-top">
    <div class="container">
        <div class="top_nav_left">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav menu__list">
                    <li class=" menu__item"><a class="menu__link" href="/product/headphones">Headphone</a></li>
                    <li class=" menu__item"><a class="menu__link" href="/product/speakers">Speakers</a></li>
                    <li class=" menu__item"><a class="menu__link" href="/product/digitalaudioplayer">Digital Audio Players</a></li>
                    <li class=" menu__item"><a class="menu__link" href="/product/accessories">Accessories</a></li>
                  </ul>
                </div>
              </div>
            </nav>  
        </div>
        <div class="top_nav_right">
            <div class="wthreecartaits wthreecartaits2 cart cart box_1"> 
                <form action="/cart" method="get">
                    <button class="w3view-cart" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>    
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //banner-top -->
@guest
<!-- Modal1 -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body modal-body-sub_agile">
                        <div class="col-md-8 modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign">Sign In <span>Now</span></h3>
                        <form action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="styled-input agile-styled-input-top">
                                <input type="email" name="email" required="">
                                <label>Email</label>
                                <span></span>
                            </div>
                            <div class="styled-input">
                                <input type="password" name="password" required=""> 
                                <label>Password</label>
                                <span></span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <input type="submit" value="Sign In">
                        </form>
                        
                        <!--Social Login-->
                        
                                                        <div class="clearfix"></div>
                                                        <p><a href="#" data-toggle="modal" data-target="#myModal2" > Don't have an account?</a></p>

                        </div>
                        <div class="col-md-4 modal_body_right modal_body_right1">
                            <img src="images/log_pic.jpg" height="300px" alt=" "/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //Modal content-->
            </div>
        </div>
<!-- //Modal1 -->
<!-- Modal2 -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body modal-body-sub_agile">
                        <div class="col-md-12 modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign">Sign Up <span>Now</span></h3>
                         <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="styled-input agile-styled-input-top{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <input type="text" name="lastname" value="{{ old('lastname') }}" required autofocus>
                                <label>Lastname</label>
                                <span></span>
                            </div>
                            <div class="styled-input{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <input type="text" name="firstname" value="{{ old('firstname') }}" required autofocus> 
                                <label>Firstname</label>
                                <span></span>
                            </div>
                            <div class="styled-input{{ $errors->has('mobilenumber') ? ' has-error' : '' }}">
                                <input type="text" name="mobilenumber" value="{{ old('mobilenumber') }}" required autofocus> 
                                <label>Mobile Number</label>
                                <span></span>
                            </div>
                            <div class="styled-input{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus> 
                                <label>Email</label>
                                <span></span>
                            </div> 
                            <div class="styled-input{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" required=""> 
                                <label>Password</label>
                                <span></span>
                            </div> 
                            <div class="styled-input{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input type="password" name="password_confirmation" required=""> 
                                <label>Confirm Password</label>
                                <span></span>
                            </div>
                            
                            <div class="styled-input{{ $errors->has('address') ? ' has-error' : '' }}">
                                <input type="text" name="address" value="{{ old('address') }}" required autofocus> 
                                <label>Complete Address</label>
                                <span></span>
                            </div>
                            <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}"> 
                                {{Form::select('province', App\Province::pluck('name', 'id'), null,['class' => 'form-control provincecategory', 'placeholder' => 'Select Province',  'style' => 'height:35px !important;'])}}
                                <span></span>
                            </div>

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-default">
                                        Upload Avatar <input type="file" name="avatar" style="display: none;">
                                    </span>
                                </label>
                                <input style="text-align: center;" type="text" class="form-control" readonly>
                            </div>
                            

                            <input type="submit" value="Register" class="pull-right">
                        
                        </form>
                            <div class="clearfix"></div>
                            <p><a href="#">By clicking register, I agree to your terms</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //Modal content-->
            </div>
        </div>
<!-- //Modal2 -->

@else
<!-- Modal3 -->
        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                        <div class="modal-body modal-body-sub_agile">
                        <div class="col-md-7 modal_body_left modal_body_left1">
                        {{-- title of modal first name + last name + account --}}
                        <h3 class="agileinfo_sign">Account <span>Information</span></h3>

                        {{-- user information --}}
                        <div class="agile-styled-input-top">
                            <label>Name </label>
                            <input type="text" name="name" value="{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}" readonly>
                            <span></span>
                        </div>
                        <p class="pull-right"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
                        <br>
                        <div class="agile-styled-input-top">
                            <label>Email Address</label>
                            <input type="text" name="email" value="{{ Auth::user()->email }}" readonly>
                            <span></span>
                        </div>
                        <p class="pull-right"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
                        <br>
                        <div class="agile-styled-input-top">
                            <label>Contact Number</label>
                            <input type="text" name="mobilenumber" value="{{ Auth::user()->mobilenumber }}" readonly>
                            <span></span>
                        </div>
                        <p class="pull-right"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
                        <br>
                        @if (Auth::user()->address == NULL)
                            <div class="agile-styled-input-top">
                                <label>Complete Address</label>
                                <input type="text" name="address" value="Address Unavailable" readonly>
                                <span></span>
                            </div>
                            <p class="pull-right"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
                            <br>
                        @else
                            <div class="agile-styled-input-top">
                                <label>Complete Address</label>
                                <input type="text" name="mobilenumber" value="{{ Auth::user()->address }}" readonly>
                                <span></span>
                            </div>
                            <p class="pull-right"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
                            <br>
                        @endif
                        
                        
                        
                        
                        <div class="clearfix"></div>

                        </div>
                        <div class="col-md-5 modal_body_right modal_body_right1">
                            {{-- avatar image display --}}
                            <img src="{{ asset('images/avatars/' . Auth::user()->avatar) }}" height="200px" alt="avatar" style="border: solid 0.1px grey !important;" />
                            
                            {{-- update avatar form --}}
                            <form enctype="multipart/form-data" action="/avatar/change" method="POST" id="updateAvatarForm">
                                {{ csrf_field() }}
                                <div class="input-group" style="margin-bottom: 0px !important; border: solid 0.1px grey !important;">
                                    <label class="input-group-btn">
                                        <span class="btn btn-default">
                                            <i class="fa fa-folder-open" aria-hidden="true"></i><input type="file" name="avatar" style="display: none;">
                                        </span>
                                    </label>
                                    <input style="text-align: center; border: 1px;" type="text" class="form-control" readonly>
                                </div>
                                <input type="submit" value="Update Avatar" style="width: 100%;" class="btn btn-default pull-right">
                            </form>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit" value="Transactions" style="margin-top: 10%; width: 100%;" class="btn btn-default pull-right">
                            </form>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit" value="Payments" style="margin-top: 1%; width: 100%;" class="btn btn-default pull-right">
                            </form>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit" value="Logout" style="margin-top: 1%; width: 100%;" class="btn btn-default pull-right">
                            </form>

                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //Modal content-->
            </div>
        </div>
<!-- //Modal3 -->
@endif
