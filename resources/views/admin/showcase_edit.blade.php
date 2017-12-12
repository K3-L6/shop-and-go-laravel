@extends('layouts.admin')
@section('header')
 Showcase File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item"><a href="/admin/filemaintenance/showcase">Showcase</a></li>
      <li class="breadcrumb-item active">Edit</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		<div class="col-md-12" style="width: 100%;">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-close">
                
              </div>
              <div class="card-header d-flex align-items-center">
                <h4>Showcase Edit Form</h4>
              </div>
              <div class="card-body">
                <form class="form-horizontal" action="/admin/filemaintenance/showcase/edit/{{ $showcase->id }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label" name="name">Showcase Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" value="{{ $showcase->name }}">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="8" name="description">{{ $showcase->description }}</textarea>
                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Current Banner</label>
                    <div class="col-sm-9">
                      
                      <img src="{{ asset('images/showcasebanners/' . $showcase->banner) }}" style="width: 100%; height: 300px;">

                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Upload New Banner</label>
                    <div class="col-sm-9">
                      
                      <label class="custom-file col-sm-9">
                        <input type="file" id="file" class="custom-file-input" name="file">
                        <span class="custom-file-control" id="upload-file-info"></span>
                      </label>

                      @if ($errors->has('file'))
                          <span class="help-block">
                              <strong>{{ $errors->first('file') }}</strong>
                          </span>
                      @endif

                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="col-md-4 offset-md-8">
                      <input type="hidden" name="_method" value="PUT">
                      <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
    </div>
	</div>
@endsection

