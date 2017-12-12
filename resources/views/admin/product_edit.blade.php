@extends('layouts.admin')
@section('header')
 Product File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item"><a href="/admin/filemaintenance/product">Products</a></li>
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
                <h4>Product Edit Form</h4>
              </div>
              <div class="card-body">
                <form class="form-horizontal" action="/admin/filemaintenance/product/edit/{{$product->id}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label" name="name">Product Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Category</label>
                    <div class="col-sm-9">
                      {{Form::select('category', App\Category::pluck('name', 'id'), $product->category->id ,['class' => 'form-control', 'placeholder' => 'Select Category',  'style' => 'height:42px !important;'])}}
                      @if ($errors->has('category'))
                          <span class="help-block">
                              <strong>{{ $errors->first('category') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Brand</label>
                    <div class="col-sm-9">
                      {{Form::select('brand', App\Brand::pluck('name', 'id'), $product->brand->id,['class' => 'form-control', 'placeholder' => 'Select Brand', 'style' => 'height:42px !important;'])}}
                      @if ($errors->has('brand'))
                          <span class="help-block">
                              <strong>{{ $errors->first('brand') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Quantity</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
                      @if ($errors->has('quantity'))
                          <span class="help-block">
                              <strong>{{ $errors->first('quantity') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Price</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                      @if ($errors->has('price'))
                          <span class="help-block">
                              <strong>{{ $errors->first('price') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="article-ckeditor" rows="8" name="description">{{$product->description}}</textarea>
                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
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

