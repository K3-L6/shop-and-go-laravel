@extends('layouts.admin')
@section('header')
 Monthly Sales
@endsection
@section('content')
	<ul class="breadcrumb">
	  <div class="container-fluid">
	    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
	    <li class="breadcrumb-item active">Monthly Sales</li>
	  </div>
	</ul>

	<div class="container" style="padding-top: 3%;">
		
		<div class="col-md-12" style="width: 100%;">
          <div class="card">
          	<div class="card-close">
          	  
          	</div>
      			<div class="card-header d-flex align-items-center">
      			  <h3 class="h4">Monthly Sales Table</h3>
      			</div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="inventorylist_table" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
                </div>
                <div id="chartContainer" style="width: 100%; height: 300px"></div>
            </div>
          </div>
        </div>
	</div>
@endsection


{{-- @push('scripts')
  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script> 
  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script> 
  <script type="text/javascript">
  window.onload = function() {
    $("#chartContainer").CanvasJSChart({ 
      title: { 
        text: "Monthly Sales Report" 
      }, 
      axisY: { 
        prefix: "P" 
      }, 
      data: [ 
      { 
        type: "stepLine", 
        toolTipContent: "{x}: ${y}",
        markerSize: 0, 
        dataPoints: [ 

          @foreach ($report as $item)
            {x: {{$item->Monthly}}, y: {{$item->Subtotal}} }, 
          @endforeach
        ] 
      } 
      ] 
    });
  }
  </script>
@endpush --}}


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
                 title: function(){ return 'Monthly Sales Report' },
                 exportOptions: {
                     columns: ':visible'
                 },

             }
        ],
        ajax:"{{ route('admin.report4.api') }}",
        columns: [
          {data : 'Monthly', name:'Monthly'},
          {data : 'Subtotal', name:'Subtotal'},
        ]
      });
    </script>
@endpush
