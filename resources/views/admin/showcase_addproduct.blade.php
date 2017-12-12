@extends('layouts.admin')
@section('header')
 Showcase File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item"><a href="/admin/filemaintenance/showcase">Showcase</a></li>
      <li class="breadcrumb-item active">Add Product</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		<div class="col-md-12" style="width: 100%;">
        
        <div class="row">
         
        <div class="col-lg-6">
          <div class="card">
            <div class="card-close">
              
            </div>
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Available Products</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="product_table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Brand</th>
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

        <div class="col-lg-6">                           
          <div class="card">
            <div class="card-close">
              
            </div>
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">{{ $showcase->name }} Showcase Items</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="showcaseitem_table">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>ID</th>
                      <th>Product Name</th>
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
    </div>
	</div>

@endsection

@push('datatables_scripts')
  <script type="text/javascript">
      $('#showcaseitem_table').DataTable({
        processing: true,
        serverSide:true,
        dom: 'Bfrtip',
        colReorder: true,
        responsive: true,
        buttons: [
             {extend:'colvis', text:'Toggle Columns'},
        ],
        bLengthChange: false,
        ajax:"{{ route('admin.showcase.item.api', ['id' => $showcase->id]) }}",
        columns: [
          {data: 'action', name: 'action', orderable:false, searchable:false},
          {data: 'id', name: 'id'},
          {data: 'product.name', name: 'product.name', "width": "90%"},
        ]
      });
    </script>
@endpush

@push('datatables_scripts')
  <script type="text/javascript">
      $('#product_table').DataTable({
        processing: true,
        serverSide:true,
        dom: 'Bfrtip',
        colReorder: true,
        responsive: true,
        buttons: [
             {extend:'colvis', text:'Toggle Columns'},
        ],
        bLengthChange: false,
        ajax:"{{ route('admin.showcase.product.api', ['id' => $showcase->id]) }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name', "width": "30%"},
          {data: 'category.name', name: 'category.name', "width": "20%"},
          {data: 'brand.name', name: 'brand.name', "width": "20%"},
          {data: 'price', name: 'price', "width": "10%"},
          {data: 'percent_off', name: 'percent_off', "width": "15%"},
          {data: 'action', name: 'action', orderable:false, searchable:false, "width": "10%"},

        ]
      });
    </script>
@endpush