@extends('layouts.admin')
@section('header')
 Moneytransfer File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item"><a href="/admin/filemaintenance/moneytransfer">Moneytransfer</a></li>
      <li class="breadcrumb-item active">Create</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		<div class="col-md-12" style="width: 100%;">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-close">
                
              </div>
              <div class="card-header d-flex align-items-center">
                <h4>Moneytransfer Registration Form</h4>
              </div>
              <div class="card-body">
                <form class="form-horizontal" action="/admin/filemaintenance/moneytransfer/create" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label" name="name">Service Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Instructions</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="8" id="article-ckeditor" name="instruction"></textarea>
                      @if ($errors->has('instruction'))
                          <span class="help-block">
                              <strong>{{ $errors->first('instruction') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-4 offset-md-8">
                      <button type="submit" class="btn btn-block btn-primary">Register</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
    </div>
	</div>
@endsection

