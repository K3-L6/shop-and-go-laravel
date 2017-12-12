@extends('layouts.admin')
@section('header')
 Customaer Relations
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Customer List</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Customer Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="user_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Customer Name</th>
                      <th>Province</th>
                      <th>City</th>
                      <th>Address</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
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
      $('#user_table').DataTable({
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
                 title: function(){ return 'Customer List' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.user.api') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'customername', name: 'customername'},
          {data: 'province.name', name: 'province.name'},
          {data: 'city.name', name: 'cit.name'},
          {data: 'address', name: 'address'},
          {data: 'email', name: 'email'},
          {data: 'mobilenumber', name: 'mobilenumber'},
          {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
      });
    </script>
@endpush
