@extends('layouts.admin')
@section('header')
 Product File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item"><a href="/admin/filemaintenance/product">Products</a></li>
      <li class="breadcrumb-item active">Specifications</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		<div class="col-md-12" style="width: 100%;">
        <div class="row">
          
        <div class="col-lg-8">                           
          <div class="card">
            <div class="card-close">
              
            </div>
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">{{ $product->name }} Specifications</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="specification_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Value</th>
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
        <!-- Modal Form-->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-close">
              
            </div>
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Add Specification</h3>
            </div>
            <div class="card-body">

              <form class="form-horizontal" action="/admin/filemaintenance/product/specification/create/{{$product->id}}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                  <label class="col-sm-12 form-control-label">Name</label>
                  <div class="col-sm-12">
                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-12 form-control-label">Value</label>
                  <div class="col-sm-12">
                    <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="value">
                    @if ($errors->has('value'))
                        <span class="help-block">
                            <strong>{{ $errors->first('value') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">       
                  <div class="col-sm-12">
                    <input type="submit" value="Register" class="btn btn-block btn-primary">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    
        </div>
    </div>
	</div>
  
  @foreach ($product->productspecification as $specification)

    <div id="specificationeditmodal{{$specification->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 id="exampleModalLabel" class="modal-title">Specification Edit</h4>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">

            <form action="/admin/filemaintenance/product/specification/edit/{{ $specification->id }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              
              <div class="form-group row">
                <label class="col-sm-12 form-control-label">Name</label>
                <div class="col-sm-12">
                  <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="name" value="{{ $specification->name }}">
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-12 form-control-label">Value</label>
                <div class="col-sm-12">
                  <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="value" value="{{ $specification->value }}">
                  @if ($errors->has('value'))
                      <span class="help-block">
                          <strong>{{ $errors->first('value') }}</strong>
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
  @endforeach

@endsection

@push('datatables_scripts')
  <script type="text/javascript">
      $('#specification_table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide:true,
        bLengthChange: false,
        colReorder: true,
        responsive: true,
        buttons: [
             {extend:'colvis', text:'Toggle Columns'},
        ],
        ajax:"{{ route('admin.specification.api', ['id' => $product->id]) }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'value', name: 'value'},
          {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
      });
    </script>
@endpush

