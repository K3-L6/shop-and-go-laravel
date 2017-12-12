@extends('layouts.admin')
@section('header')
 Customer Orders Transaction
@endsection
@section('content')
  <ul class="breadcrumb">
    <div class="container-fluid">
      <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
      <li class="breadcrumb-item active">Orders</li>
    </div>
  </ul>

  <div class="container" style="padding-top: 3%;">
    
    <div class="col-md-12" style="width: 100%;">
          <div class="card">
            <div class="card-close">
              
            </div>
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Orders Table</h3>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="order_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Customer Name</th>
                      <th>Province</th>
                      <th>City</th>
                      <th>Address</th>
                      <th>Mobile Number</th>
                      <th>Purchase Type</th>
                      <th>Total</th>
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
                 title: function(){ return 'Customer Orders' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.order.api') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'customername', name: 'customername'},
          {data: 'province', name: 'province'},
          {data: 'city', name: 'city'},
          {data: 'address', name: 'address'},
          {data: 'mobilenumber', name: 'mobilenumber'},
          {data: 'purchase_type', name: 'purchase_type'},
          {data: 'total', name: 'total'},
          {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
      });
    </script>
@endpush
