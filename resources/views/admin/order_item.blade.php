@extends('layouts.admin')
@section('header')
 Customer Orders Transaction
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
      <li class="breadcrumb-item"><a href="/admin/transaction/order">Order</a></li>
	    <li class="breadcrumb-item active">Items</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Orders Item Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="order_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Price</th>
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
@endsection

@push('datatables_scripts')
  <script type="text/javascript">
      $('#order_table').DataTable({
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
                 title: function(){ return 'Customer Orders Items' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.order.item.api', ['id' => $orderid]) }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'product.name', name: 'product.name'},
          {data: 'product.category.name', name: 'product.category.name'},
          {data: 'product.brand.name', name: 'product.brand.name'},
          {data: 'subtotal', name: 'subtotal'},
          {data: 'action', name: 'action'},
        ]
      });
    </script>
@endpush
