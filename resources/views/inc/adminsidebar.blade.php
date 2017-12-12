
<nav class="side-navbar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="{{ asset('adminresource/images/avatars/' . Auth::user('admin')->avatar) }}" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h4">{{ucwords(Auth::user('admin')->firstname) . ' ' . ucwords(Auth::user('admin')->lastname)}}</h1>
      <p>{{ucwords(Auth::user('admin')->job)}}</p>
    </div>
  </div>

  <span class="heading">MENU</span>
  <ul class="list-unstyled">
    <li> <a href="/admin/dashboard"><i class="fa fa-bar-chart" aria-hidden="true"></i>Dashboard</a></li>
    {{-- <li> <a href="#"><i class="fa fa-calculator" aria-hidden="true"></i>Walk In Transactions</a></li> --}}
    
    <li><a href="#productinventory" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cube" aria-hidden="true"></i> Product Inventory </a>
      <ul id="productinventory" class="collapse list-unstyled">
        <li><a href="/admin/productinventory/inventorylist">Inventory List</a></li>
        <li><a href="/admin/productinventory/productmovement">Product Movement</a></li>
        <li><a href="/admin/productinventory/orderproductmovement">Order, Product Movement</a></li>
      </ul>
    </li>

    <li><a href="#salesreport" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-book" aria-hidden="true"></i> Reports </a>
      <ul id="salesreport" class="collapse list-unstyled">
        <li><a href="/admin/salesreport/report1">Daily Sales Report by Product and Order</a></li>
        <li><a href="/admin/salesreport/report2">Daily Sales Report by Product</a></li>
        <li><a href="/admin/salesreport/report3">Monthly sales by Product</a></li>
        <li><a href="/admin/salesreport/report4">Monthly Sales</a></li>
      </ul>
    </li>
    
    <li><a href="#transactions" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Transactions </a>
      <ul id="transactions" class="collapse list-unstyled">
        <li><a href="/admin/transaction/cancelproductrequest/">Cancelation Request</a></li>
        <li><a href="/admin/transaction/returnproductrequest/">Return Request</a></li>
        <li><a href="/admin/transaction/pending/">Payment Approvals</a></li>
        <li><a href="/admin/transaction/order/">Customer Orders</a></li>
      </ul>
    </li>
    {{-- <li><a href="#customerrelations" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-user" aria-hidden="true"></i> Customer Relations</a>
      <ul id="customerrelations" class="collapse list-unstyled">
        <li><a href="admin/customerrelation/user/">Customer List</a></li>
        <li><a href="#">Customer Reviews</a></li>
      </ul>
    </li> --}}
    <li><a href="#filemaintenance" aria-expanded="false" data-toggle="collapse"><i class="fa fa-file" aria-hidden="true"></i>File Maintenance </a>
      <ul id="filemaintenance" class="collapse list-unstyled">
        <li><a href="/admin/filemaintenance/moneytransfer">Money Transfers</a></li>
        <li><a href="/admin/filemaintenance/showcase">Showcase Group</a></li>
        <li><a href="/admin/filemaintenance/brand">Brand</a></li>
        <li><a href="/admin/filemaintenance/product">Products</a></li>
      </ul>
    </li>
    {{-- <li><a href="#archive" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-archive" aria-hidden="true"></i> Archive </a>
      <ul id="archive" class="collapse list-unstyled">
        <li><a href="/admin/filemaintenance/product">Money Transfer</a></li>
        <li><a href="/admin/filemaintenance/product">Product</a></li>
        <li><a href="/admin/filemaintenance/product">Orders</a></li>
        <li><a href="/admin/filemaintenance/product">Customer Account</a></li>
      </ul>
    </li> --}}
  </li>
  </ul>


</nav>