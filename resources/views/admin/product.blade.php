@extends('layouts.admin')
@section('header')
 Products File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Products</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	
            <div class="card-close">
          	  
              <a href="/admin/filemaintenance/product/create" class="btn btn-sm btn-primary" style="margin:0px !important;">Create New <i class="fa fa-plus" aria-hidden="true"></i></a>
              
          	</div>
      			
            <div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Product Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="product_table" class="table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Initial Quantity</th>
                      <th>Price</th>
                      <th>% Off</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
	</div>


  @foreach ($products as $product)
    <div id="percentoffmodal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 id="exampleModalLabel" class="modal-title">{{ $product->name }} Percent Off Edit</h4>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">

            <form action="/admin/filemaintenance/product/percentoff/edit/{{ $product->id }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              
              <div class="form-group row">
                <div class="col-sm-12">
                  <input id="inputHorizontalSuccess" type="number" class="form-control form-control-success" name="percent_off" value="{{ $product->percent_off }}">
                  @if ($errors->has('percent_off'))
                      <span class="help-block">
                          <strong>{{ $errors->first('percent_off') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row" style="margin-bottom: 0px;">
                <div class="col-md-12">
                  <input type="hidden" name="_method" value="PUT">
                  <button type="submit" class="btn btn-block btn-primary">Update</button>
                </div>
              </div>

            </form>
          </div>
          
        </div>
      </div>
    </div>


  <div id="replenish{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="exampleModalLabel" class="modal-title">{{$product->name}}</h4>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">

          <form action="/admin/filemaintenance/product/replenish/{{ $product->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="form-group row">
              <label class="col-sm-12 form-control-label">Initial Quantity</label>
              <div class="col-sm-12">
                <input id="inputHorizontalSuccess" type="number" min="{{$product->init_qty}}" class="form-control form-control-success" value="{{$product->init_qty}}" readonly>
              </div>
            </div>            

            <div class="form-group row">
              <label class="col-sm-12 form-control-label">New Stock</label>
              <div class="col-sm-12">
                <input id="inputHorizontalSuccess" type="number" min="0" class="form-control form-control-success" name="init_qty">
                @if ($errors->has('init_qty'))
                    <span class="help-block">
                        <strong>{{ $errors->first('init_qty') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row" style="margin-bottom: 0px;">
              <div class="col-md-12">
                <button type="submit" class="btn btn-block btn-primary">Update</button>
              </div>
            </div>

          </form>
        </div>
        
      </div>
    </div>
  </div>

  @endforeach


@endsection


@push('datatables_scripts')
  <script type="text/javascript">
      $('#product_table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide:true,
        colReorder: true,
        responsive: true,
        buttons: [
             {extend:'colvis', text:'Toggle Columns'},
        ],
        ajax:"{{ route('admin.product.api') }}",

        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'description', name: 'description'},
          {data: 'category.name', name: 'category.name'},
          {data: 'brand.name', name: 'brand.name'},
          {data: 'init_qty', name: 'init_qty'},
          {data: 'price', name: 'price'},
          {data: 'percent_off', name: 'percent_off'},
          {data: 'action', name: 'action', orderable:false, searchable:false, printable:false},

        ]
      });
    </script>
@endpush