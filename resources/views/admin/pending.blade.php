@extends('layouts.admin')
@section('header')
 Money Transfer Transaction
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Payments</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Money Transfers Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pending_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 30%;">Receipt</th>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Provider</th>
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

@foreach ($mtp as $mtp)
  <div id="receiptmodal{{$mtp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          
          <img class="img-fluid img-thumbnail" src="{{ asset('images/receipts/' . $mtp->receipt) }}" style="height: 350px; width: 100%; margin-bottom: 3%;">


          <a href="#" data-dismiss="modal" class="btn btn-sm btn-primary btn-block col-md-12">Cancel</a>

        </div>
        
      </div>
    </div>
  </div>
@endforeach



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
                 title: function(){ return 'Pending Money Transfers' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.pending.api') }}",
        columns: [

          {data: 'receipt', name: 'receipt', orderable:false, searchable:false},
          {data: 'order_id', name: 'order_id'},
          {data: 'customer_name', name: 'customer_name'},
          {data: 'moneytransfer.name', name: 'moneytransfer.name'},
          {data: 'total', name: 'total'},
          
          
          {data: 'action', name: 'action', orderable:false, searchable:false},
        ]
      });
    </script>
@endpush
