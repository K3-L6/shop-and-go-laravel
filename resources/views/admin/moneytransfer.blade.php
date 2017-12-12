@extends('layouts.admin')
@section('header')
 Money Transfers File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Money Transfers</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  <a href="/admin/filemaintenance/moneytransfer/create" class="btn btn-sm btn-primary">Create New <i class="fa fa-plus" aria-hidden="true"></i></a>
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Money Transfers Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="moneytransfer_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Instruction</th>
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
      $('#moneytransfer_table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide:true,
        bLengthChange: false,
        colReorder: true,
        responsive: true,
        buttons: [
             {extend:'colvis', text:'Toggle Columns'},
        ],
        ajax:"{{ route('admin.moneytransfer.api') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'instruction', name: 'instruction'},
          {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
      });
    </script>
@endpush
