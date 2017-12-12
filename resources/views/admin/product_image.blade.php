@extends('layouts.admin')
@section('header')
 Product File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item"><a href="/admin/filemaintenance/product">Products</a></li>
      <li class="breadcrumb-item active">Image</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		<div class="col-md-12" style="width: 100%;">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-close">

                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Upload Images </button>
                
                {{-- modal upload --}}
                <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 id="exampleModalLabel" class="modal-title">Image Upload</h4>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">

                        <form action="/admin/filemaintenance/product/image/upload/{{$product->id}}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="form-group row">
                            <div class="col-sm-12">
                              
                              <label class="custom-file col-sm-9">
                                <input type="file" id="file" class="custom-file-input" name="file[]" multiple>
                                <span class="custom-file-control" id="upload-file-info"></span>
                              </label>

                              @if ($errors->has('file[]'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('file[]') }}</strong>
                                  </span>
                              @endif
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-block btn-primary">Upload</button>
                            </div>
                          </div>

                        </form>

                      </div>
                      
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-header d-flex align-items-center">
                <h4>{{ $product->name }} Images</h4>
              </div>
              <div class="card-body">

                    <div class="row text-center text-lg-left">
                      
                      @foreach ($product->productimage as $image)
                        
                        <div class="col-lg-3 col-md-4 col-xs-6">
                          <a href="#" class="d-block mb-4 h-100" data-toggle="modal" data-target="#imagemodal{{$image->id}}">
                            <img class="img-fluid img-thumbnail" src="{{ asset('images/productimages/' . $image->name) }}" style="height: 300px; width: 400px;">
                          </a>
                        </div>
                      @endforeach

                    </div>

              </div>
            </div>
          </div>
    </div>
	</div>

  @foreach ($product->productimage as $image)
    <div id="imagemodal{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            
            <img class="img-fluid img-thumbnail" src="{{ asset('images/productimages/' . $image->name) }}" style="height: 350px; width: 100%; margin-bottom: 3%;">


            <form action="/admin/filemaintenance/product/image/delete/{{$image->id}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-block btn-sm btn-danger">Delete</button>
                </div>
              </div>
            </form>

            <a href="#" data-dismiss="modal" class="btn btn-sm btn-primary btn-block col-md-12">Cancel</a>

          </div>
          
        </div>
      </div>
    </div>
  @endforeach
@endsection

