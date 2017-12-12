@extends('layouts.admin')
@section('header')
 Customers File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Customers</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  <div class="dropdown">
          	    <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
          	    <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
          	  </div>
          	</div>
			<div class="card-header d-flex align-items-center">
			  <h3 class="h4">Basic Table</h3>
			</div>

            <div class="card-body">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th style="width:15%;"></th>
                    <th style="width:15%;">Name</th>
                    <th style="width:30%;">Description</th>
                    <th style="width:15%;">Category</th>
                    <th style="width:15%;">Sub Category</th>
                    <th style="width:5%;">Quantity</th>
                    <th style="width:5%;">Price</th>
                    <th><a href="#" class="btn btn-sm btn-primary">Add New</a></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Image Here</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>
                    	<div class="dropdown">
						  <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <i class="fa fa-cogs" aria-hidden="true"></i>
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <a class="dropdown-item" href="#">Specifications</a>
						    <a class="dropdown-item" href="#">Images</a>
						    <a class="dropdown-item" href="#">Edit</a>
						    <a class="dropdown-item" href="#">Delete</a>
						  </div>
						</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
	</div>
@endsection
