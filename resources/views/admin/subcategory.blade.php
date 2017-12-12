@extends('layouts.admin')
@section('header')
 Sub Category File Maintenance
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Sub Category</li>
	  </div>
	</ul>

		
		<div class="col-lg-12" style="padding-top: 3%;">
          <div class="card">

            <div class="card-close">
              
            </div>

            <div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Sub Category Table</h3>
      			</div>

            <div class="card-body">
              {!! $dataTable->table() !!}
            </div>
          </div>

          <!-- Modal-->
          


        </div>



        
@endsection

@push('datatables_scripts')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  <script src="/vendor/datatables/buttons.server-side.js"></script>
  {!! $dataTable->scripts() !!}
@endpush
{{-- @push('datatables_scripts')
  <script type="text/javascript">
      $('#subcategory_table').DataTable({
        processing: true,
        serverSide:true,
        bLengthChange: false,
        ajax:"{{ route('admin.subcategory.api') }}",
        columns: [
          {data: 'name', name: 'name'},
          {data: 'category.name', name: 'category.name'},
          {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
      });
    </script>
@endpush --}}