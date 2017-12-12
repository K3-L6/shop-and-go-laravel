@extends('layouts.admin')
@section('header')
 Dashboard
@endsection
@section('content')
<section class="dashboard-counts no-padding-bottom">
  <div class="container-fluid">
    <div class="row bg-white has-shadow">
      <!-- Item -->
      <div class="col-xl-3 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-violet"><i class="icon-user"></i></div>
          <div class="title"><span>Receipt<br>For Printing</span>
            <div class="progress">
              <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
            </div>
          </div>
          <div class="number"><strong>{{$forprinting}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-3 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-red"><i class="icon-padnote"></i></div>
          <div class="title"><span>Order<br>For Dispatch</span>
            <div class="progress">
              <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
            </div>
          </div>
          <div class="number"><strong>{{$fordispatch}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-3 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-green"><i class="icon-bill"></i></div>
          <div class="title"><span>Payment<br>For Verification</span>
            <div class="progress">
              <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
            </div>
          </div>
          <div class="number"><strong>{{$forverification}}</strong></div>
        </div>
      </div>
      <!-- Item -->
      <div class="col-xl-3 col-sm-6">
        <div class="item d-flex align-items-center">
          <div class="icon bg-orange"><i class="icon-check"></i></div>
          <div class="title"><span>Orders Fulfilled<br></span>
            <div class="progress">
              <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
            </div>
          </div>
          <div class="number"><strong>{{$orderfulfilled}}</strong></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="dashboard-header">
  <div class="container-fluid">
    <div class="row">
      <!-- Statistics -->
      {{-- <div class="statistics col-lg-3 col-12">
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
          <div class="text"><strong>1</strong><br><small>Total Sale</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
          <div class="text"><strong>1</strong><br><small>Product Count</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
          <div class="text"><strong>1</strong><br><small>Product Review</small></div>
        </div>
      </div> --}}
      <!-- Line Chart            -->
      <div class="col-lg-9">
        <div class="checklist card">
          <div class="card-close">
            <div class="dropdown">
              <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
              <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
            </div>
          </div>
          <div class="card-header d-flex align-items-center">           
            <h2 class="h3"> Product On Critical Level Quantity </h2>
          </div>
          <div class="card-body no-padding">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($criticallevel as $item)
                  <tr>
                    <td>{{$item->product_id}}</td>
                    <td>
                      @foreach ($product as $product)
                        @if ($product->id == $item->product_id)
                          {{$product->name}}
                        @endif
                      @endforeach
                    </td>
                    <td>{{$item->qty}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      
    </div>
  </div>
</section>
@endsection
