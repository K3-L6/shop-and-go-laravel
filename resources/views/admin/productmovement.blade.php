@extends('layouts.admin')
@section('header')
 Product Movement
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Product Movement</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Product Movement Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="productmovement_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Quantity</th>
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
@endsection

@push('datatables_scripts')
  <script type="text/javascript">
      $('#productmovement_table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide:true,
        bLengthChange: false,
        colReorder: true,
        responsive: true,
        buttons: [
             {extend:'colvis', text:'Toggle Columns'},
             {
                 extend: 'print',
                 title: function(){ return 'Inventory List' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.productmovement.api') }}",
        columns: [
          {data: 'product_id', name: 'product_id'},
          {data: 'product_name', name: 'product_name'},
          {data: 'product_category', name: 'product_category'},
          {data: 'product_brand', name: 'product_brand'},
          {data: 'sum_qty', name: 'sum_qty'},
        ]
      });
    </script>
@endpush
