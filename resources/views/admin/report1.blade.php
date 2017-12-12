@extends('layouts.admin')
@section('header')
 Daily Sales Report by Product and Order
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Daily Sales Report by Product and Order</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Daily Sales Report by Product and Order Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="inventorylist_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Date</th>
                      <th>Subtotal</th>
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
      $('#inventorylist_table').DataTable({
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
                 title: function(){ return 'Daily Sales Report by Product and Order' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.report1.api') }}",
        columns: [
          {data: 'order_id', name: 'order_id'},
          {data: 'customer_name', name: 'customer_name'},
          {data : 'product_name', name:'product_name'},
          {data : 'product_category', name:'product_category'},
          {data : 'product_brand', name:'product_brand'},
          {data : 'created_at', name:'created_at'},
          {data : 'subtotal', name:'subtotal'},
        ]
      });
    </script>
@endpush
