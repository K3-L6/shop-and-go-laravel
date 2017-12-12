@extends('layouts.admin')
@section('header')
 Cancel Request
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Cancel Request</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Cancel Request Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pending_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Order Item ID</th>
                      <th>Customer Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Reason</th>
                      <th>Date</th>
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
      $('#pending_table').DataTable({
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
                 title: function(){ return 'Cancel Order Request' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.cancelproductrequest.api') }}",
        columns: [

          {data: 'order_id', name: 'order_id',},
          {data: 'id', name: 'id',},
          {data: 'customer_name', name: 'customer_name'},
          {data: 'customer_email', name: 'customer_email'},
          {data: 'customer_mobile', name: 'customer_mobile'},
          {data: 'reason', name: 'reason'},
          {data: 'created_at', name: 'created_at'},
          
        ]
      });
    </script>
@endpush
