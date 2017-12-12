<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

//model imports
use App\Product;
use App\Subcategory;
use App\Category;
use App\Brand;
use App\Productimage;
use App\Productspecification;
use App\Showcase;
use App\Showcaseitem;
use App\Moneytransfer;
use App\Moneytransferpending;
use App\Order;
use App\Orderitem;
use App\Sale;
use App\User;
use App\Review;
use App\Archiveuser;
use App\Transactionactivity;
use App\Cancelrequest;

use Mail;
use App\Mail\ReceiptPrinted;
use App\Mail\OrderDispatched;
use App\Mail\FulfillOrder;
use App\Mail\PendingValidated;
use App\Mail\PendingDecline;
use App\Mail\CancelSuccess;
use App\Mail\ReturnSuccess;
use App\Cancelproductrequest;
use App\Returnproductrequest;

//package imports
use Yajra\DataTables\Datatables;
use PDF;
use DB;

use Auth;


//datatables imports
use App\DataTables\SubcategoryDataTable;
use Image;



class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function cancelproductrequest()
    {
        return view('admin.cancelproductrequest');
    }

    public function cancelproductrequest_api()
    {
        $cpr = Cancelproductrequest::with('orderitem', 'user')->orderBy('created_at', 'desc')->get();
        $orderitem = Orderitem::all();
        return Datatables::of($cpr)
        ->editColumn('order_id', function($cpr) use($orderitem){
            foreach ($orderitem as $item) {
                if($item->id == $cpr->orderitem_id)
                {
                    return str_pad($item->order_id, 10, '0', STR_PAD_LEFT);       
                }
            }
        })
        ->editColumn('customer_name', function($cpr){
            return $cpr->user->firstname . ' ' . $cpr->user->lastname;
        })
        ->editColumn('customer_email', function($cpr){
            return $cpr->user->email;
        })
        ->editColumn('customer_mobile', function($cpr){
            return $cpr->user->mobilenumber;
        })
        ->make(true);
    }

    public function returnproductrequest()
    {
        return view('admin.returnproductrequest');
    }

    public function returnproductrequest_api()
    {
        $rpr = Returnproductrequest::with('orderitem', 'user')->orderBy('created_at', 'desc')->get();
        $orderitem = Orderitem::all();
        return Datatables::of($rpr)
        ->editColumn('order_id', function($rpr) use($orderitem){
            foreach ($orderitem as $item) {
                if($item->id == $rpr->orderitem_id)
                {
                    return str_pad($item->order_id, 10, '0', STR_PAD_LEFT);       
                }
            }
        })
        ->editColumn('customer_name', function($rpr){
            return $rpr->user->firstname . ' ' . $rpr->user->lastname;
        })
        ->editColumn('customer_email', function($rpr){
            return $rpr->user->email;
        })
        ->editColumn('customer_mobile', function($rpr){
            return $rpr->user->mobilenumber;
        })
        ->make(true);
    }


    // daily sales report
    public function report1()
    {
        return view('admin.report1');
    }

    public function cancelrequest()
    {
        return view('admin.cancelrequest');
    }

    public function cancelrequest_api()
    {
        
        $cancelrequest = Cancelrequest::with('order', 'user')->orderBy('created_at', 'desc')->get();
        return Datatables::of($cancelrequest)
        ->editColumn('order_id', function($cancelrequest){
            return str_pad($cancelrequest->order_id, 10, '0', STR_PAD_LEFT);
        })
        ->editColumn('customer_name', function($cancelrequest){
            return $cancelrequest->user->firstname . ' ' . $cancelrequest->user->lastname;
        })
        ->editColumn('customer_email', function($cancelrequest){
            return $cancelrequest->user->email;
        })
        ->editColumn('customer_mobile', function($cancelrequest){
            return $cancelrequest->user->mobilenumber;
        })
        ->make(true);

    }

    public function report1_api()
    {
        $report = DB::table('v_oisales')->get();
        $product = Product::all();
        $order = Order::all();
        
        return Datatables::of($report)
        ->editColumn('customer_name', function($report) use ($order){
            foreach ($order as $item) {
                if($item->id == $report->order_id)
                {
                    return $item->firstname . ' ' . $item->lastname;
                }
            }
        })
        ->editColumn('product_name', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->product_id)
                {
                    return $item->name;
                }
            }
        })
        ->editColumn('product_category', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->product_id)
                {
                    return $item->category->name;
                }
            }
        })
        ->editColumn('product_brand', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->product_id)
                {
                    return $item->brand->name;
                }
            }
        })
        
        ->make(true);
    }

    public function report2()
    {
        return view('admin.report2');
    }

    public function report2_api()
    {
        $report = DB::table('v_oisales_p')->get();
        $product = Product::all();
        
        return Datatables::of($report)
        ->editColumn('product_name', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->product_id)
                {
                    return $item->name;
                }
            }
        })
        ->editColumn('product_category', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->product_id)
                {
                    return $item->category->name;
                }
            }
        })
        ->editColumn('product_brand', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->product_id)
                {
                    return $item->brand->name;
                }
            }
        })
        ->make(true);
    }

    public function report3()
    {
        return view('admin.report3');
    }

    public function report3_api()
    {
        $report = DB::table('v_oisales_pmo')->get();
        $product = Product::all();

        return Datatables::of($report)
        ->editColumn('product_name', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->pid)
                {
                    return $item->name;
                }
            }
        })
        ->editColumn('product_category', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->pid)
                {
                    return $item->category->name;
                }
            }
        })
        ->editColumn('product_brand', function($report) use ($product){
            foreach ($product as $item) {
                if($item->id == $report->pid)
                {
                    return $item->brand->name;
                }
            }
        })
        ->make(true);
    }

    public function report4()
    {
        $report = DB::table('v_oisales_pmonth')->orderBy('Monthly', 'desc')->get();
        return view('admin.report4')->withReport($report);
    }

    public function report4_api()
    {
        $report = DB::table('v_oisales_pmonth')->get();
        
        return Datatables::of($report)
        
        ->make(true);
    }



    



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forprinting = count(Order::where('status', 'Order Received')->get());
        $fordispatch = count(Order::where('status', 'Receipt Printed')->get());
        $forverification = count(Order::where('status', 'Pending Verification')->get());
        $orderfulfilled = count(Order::where('status', 'Order FulFilled')->get());

        $productcount = count(Product::all());

        $criticallevel = DB::table('v_critical_product')->get();
        $product = Product::all();

        // return $fordelivery;
        
        // return $pendingorders;
        return view('admin.dashboard')->withForprinting($forprinting)->withFordispatch($fordispatch)->withForverification($forverification)
        ->withOrderfulfilled($orderfulfilled)->withProductcount($productcount)->withCriticallevel($criticallevel)->withProduct($product);
    }

    public function user()
    {
        return view('admin.user');
    }

    public function user_delete($id)
    {
        $archiveuser = new Archiveuser;
    
    }

    public function user_api()
    {
        $user = User::with('province', 'city')->get();
        return Datatables::of($user)
        ->editColumn('customername', function($user){
            return $user->firstname . ' ' . $user->lastname;
        })
        ->addColumn('action', function($user){
            return '
                
                    <div class="dropdown">
                      <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                      </button>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <form action="/admin/transaction/order/item/' . $user->id . '" method="get">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Email" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/item/' . $user->id . '" method="get">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="SMS" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/customerrelation/user/delete/' . $user->id . '" method="POST">
                            
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Delete" style="font-weight:500 !important;"> 
                            
                        </form>
                      </div>
                    </div>
                  
            ';
        })
        ->make(true);
    }

    public function pending()
    {
        $mtp = Moneytransferpending::all();
        return view('admin.pending')->withMtp($mtp);
    }

    public function pending_validate($id)
    {
        $mtp = Moneytransferpending::find($id);
        $order = Order::find($mtp->order_id);
        $user = User::where('email', $order->email)->first();

        $order->status = "Order Received";
        $order->save();

        $ta = new Transactionactivity;
        $ta->order_id = $id;
        $ta->user_id = $user->id;
        $ta->message = "Pending Payment Verified.";
        $ta->save();

        $mtp->delete();

        $moneytransfer = Moneytransfer::find($order->moneytransfer_id);
        Mail::to($order->email)->send(new PendingValidated($order,  $moneytransfer));

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639356040507',
            'text' => 'Your Payment is now verified. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        



        return redirect()->back()->with('success', 'Payment Verification Complete');
    }

    public function pending_decline($id)
    {
        $mtp = Moneytransferpending::find($id);
        $order = Order::find($mtp->order_id);
        $user = User::where('email', $order->email)->first();

        $order->status = "Pending Payment";
        $order->save();

        $ta = new Transactionactivity;
        $ta->order_id = $id;
        $ta->user_id = $user->id;
        $ta->message = "Pending Payment Decline.";
        $ta->save();

        $mtp->delete();
        $moneytransfer = Moneytransfer::find($order->moneytransfer_id);
        Mail::to($order->email)->send(new PendingDecline($order, $moneytransfer));

        

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639356040507',
            'text' => 'Sorry, you have uploaded a defective receipt.Please try again. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);



        return redirect()->back()->with('success', 'Payment Decline Complete');
    }

    public function pending_api()
    {
        $mtp = Moneytransferpending::with('moneytransfer')->get();
        // return $mtp->id;
        $order = Order::all();
        return Datatables::of($mtp)
        ->editColumn('receipt', function($mtp){
            return '
                <a href="#" class="d-block mb-4 h-100" data-toggle="modal" data-target="#receiptmodal'.$mtp->id.'">
                  <img src="'. asset('images/receipts/' . $mtp->receipt) .'" style="height: 150px; width: 100%;">
                </a>
                
            ';
        })
        
        ->editColumn('customer_name', function($mtp) use($order) {
            foreach ($order as $item) {
                if($item->id == $mtp->order_id){
                    return $item->firstname . ' ' . $item->lastname;       
                }
            }
        })
        ->editColumn('total', function($mtp) use($order) {
            foreach ($order as $item) {
                if($item->id == $mtp->order_id){
                    return $item->total;       
                }
            }
        })
        ->addColumn('action', function($mtp){
            return '
                
                    <div class="dropdown">
                      <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <form id="delete" action="/admin/transaction/pending/validate/' . $mtp->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Validate" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form id="delete" action="/admin/transaction/pending/decline/' . $mtp->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Decline" style="font-weight:500 !important;"> 
                            
                        </form>
                      </div>
                    </div>
                  
            ';
        })
        ->rawColumns(['receipt', 'action'])
        ->make(true);
    }


    public function order()
    {
        return view('admin.order');
    }

    public function order_verify($id)
    {
        $order = Order::find($id);
        $order->status = "For Delivery";
        $order->save();
        return redirect()->back()->with('success', 'Successfully Verified Order');
    }

    public function order_delete($id)
    {
        $order = Order::find($id);
        if($order->status == 'Cancelled Order'){
            return redirect()->back()->with('error', 'This Order is already Cancelled');
        }
        $orderitem = Orderitem::where('order_id', $order->id)->get();

        foreach ($orderitem as $item) 
        {
            $neworderitem = new Orderitem;
            $neworderitem->order_id = $id;
            $neworderitem->product_id = $item->product_id;
            $neworderitem->quantity = $item->quantity * -1;
            $neworderitem->subtotal = $item->subtotal * -1;
            $neworderitem->inactive = 'Y';
            $neworderitem->save();
        }
        $order->status = 'Cancelled Order';
        $order->save();
        return redirect()->back()->with('success', 'Successfully Updated Order');
    }

    public function order_item($id)
    {
        $orderid = $id;
        return view('admin.order_item')->withOrderid($orderid);
    }







    public function inventorylist()
    {
        return view('admin.inventorylist');
    }

    public function inventorylist_api()
    {
        $inventorylist = DB::table('v_all_inventory')->get();
        
        $product = Product::all();
        
        return Datatables::of($inventorylist)
        ->editColumn('product_name', function($inventorylist) use ($product){
            foreach ($product as $item) {
                if($item->id == $inventorylist->id)
                {
                    return $item->name;
                }
            }
        })
        ->editColumn('product_category', function($inventorylist) use ($product){
            foreach ($product as $item) {
                if($item->id == $inventorylist->id)
                {
                    return $item->category->name;
                }
            }
        })
        ->editColumn('product_brand', function($inventorylist) use ($product){
            foreach ($product as $item) {
                if($item->id == $inventorylist->id)
                {
                    return $item->brand->name;
                }
            }
        })

        ->make(true);
    }



    public function productmovement()
    {
        return view('admin.productmovement');
    }

    public function productmovement_api()
    {
        $productmovement = DB::table('v_invoitems')->get();
        $product = Product::all();
        return Datatables::of($productmovement)
        ->editColumn('product_name', function($productmovement) use ($product){
            foreach ($product as $item) {
                if($item->id == $productmovement->product_id)
                {
                    return $item->name;
                }
            }
        })
        ->editColumn('product_category', function($productmovement) use ($product){
            foreach ($product as $item) {
                if($item->id == $productmovement->product_id)
                {
                    return $item->category->name;
                }
            }
        })
        ->editColumn('product_brand', function($productmovement) use ($product){
            foreach ($product as $item) {
                if($item->id == $productmovement->product_id)
                {
                    return $item->brand->name;
                }
            }
        })
        ->make(true);
    }



    public function orderproductmovement()
    {
        return view('admin.orderproductmovement');
    }

    public function orderproductmovement_api()
    {
        $orderproductmovement = DB::table('v_oitems')->get();
        $order = Order::all();
        $product = Product::all();

        return Datatables::of($orderproductmovement)
        ->editColumn('customer_name', function($orderproductmovement) use ($order){
            foreach ($order as $item) {
                if($item->id == $orderproductmovement->order_id)
                {
                    return $item->firstname . ' ' . $item->lastname;
                }
            }
        })
        ->editColumn('customer_province', function($orderproductmovement) use ($order){
            foreach ($order as $item) {
                if($item->id == $orderproductmovement->order_id)
                {
                    return $item->province;
                }
            }
        })
        ->editColumn('customer_address', function($orderproductmovement) use ($order){
            foreach ($order as $item) {
                if($item->id == $orderproductmovement->order_id)
                {
                    return $item->address;
                }
            }
        })
        ->editColumn('product_name', function($orderproductmovement) use ($product){
            foreach ($product as $item) {
                if($item->id == $orderproductmovement->product_id)
                {
                    return $item->name;
                }
            }
        })
        ->editColumn('product_category', function($orderproductmovement) use ($product){
            foreach ($product as $item) {
                if($item->id == $orderproductmovement->product_id)
                {
                    return $item->category->name;
                }
            }
        })
        ->editColumn('product_brand', function($orderproductmovement) use ($product){
            foreach ($product as $item) {
                if($item->id == $orderproductmovement->product_id)
                {
                    return $item->brand->name;
                }
            }
        })

        ->make(true);
    }

    


    public function refund($id)
    {
        $orderitem = Orderitem::find($id);

        $neworderitem = new Orderitem;
        $neworderitem->order_id = $orderitem->order_id;
        $neworderitem->product_id = $orderitem->product_id;
        $neworderitem->quantity = $orderitem->quantity * -1;
        $neworderitem->subtotal = $orderitem->subtotal * -1;
        $neworderitem->inactive = 'Y';
        $neworderitem->save();

        $orderitem->inactive = 'Y';
        $orderitem->save();
        return redirect()->back()->with('success', 'Successfully Updated Order');
    }

    public function return($id)
    {
        $orderitem = Orderitem::find($id);
        $order = Order::find($orderitem->order_id);
        $user = User::where('email', $order->email)->first();

        $ta = new Transactionactivity;
        $ta->order_id = $orderitem->order_id;
        $ta->user_id = $user->id;
        $ta->message = "Order item # " . $orderitem->id . " is now returned";
        $ta->save();

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'Order item # ' . $orderitem->id . ' is now returned. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        Mail::to($order->email)->send(new ReturnSuccess($order, $orderitem));
        // email to mo

        $orderitem->delete();
        return redirect()->back()->with('success', 'Successfully Returned Product');
    }

    public function cancel($id)
    {
        $orderitem = Orderitem::find($id);
        $order = Order::find($orderitem->order_id);
        $user = User::where('email', $order->email)->first();

        $order->total -= $orderitem->subtotal;
        $order->save();

        $ta = new Transactionactivity;
        $ta->order_id = $orderitem->order_id;
        $ta->user_id = $user->id;
        $ta->message = "Order item # " . $orderitem->id . " is now cancelled";
        $ta->save();

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'Order item # ' . $orderitem->id . ' is now cancelled. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        Mail::to($order->email)->send(new CancelSuccess($order, $orderitem));

        $orderitem->delete();
        return redirect()->back()->with('success', 'Successfully Cancelled Product');
    }

    


    public function order_item_api($id)
    {
        $order = Order::find($id);
        $orderitems = Orderitem::with('product', 'product.category', 'product.brand')->where('order_id', $order->id)->get();
        // return $orderitems;
        return Datatables::of($orderitems)
        ->addColumn('action', function($orderitems) use($order){

            if ($order->status == 'Order FulFilled' || $order->status == 'Order Dispatched') {
                return '
                    
                        <div class="dropdown">
                          <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                          </button>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            

                            <form action="/admin/transaction/orderitem/return/' . $orderitems->id . '" method="POST">
                                
                                <input type="hidden" name="_token" value="'. csrf_token() . '">
                                <input class="dropdown-item" type="submit" value="Return Product" style="font-weight:500 !important;"> 
                                
                            </form>



                          </div>
                        </div>
                      
                ';
            }else{
                return '
                    
                        <div class="dropdown">
                          <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                          </button>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            

                            <form action="/admin/transaction/orderitem/cancel/' . $orderitems->id . '" method="POST">
                                
                                <input type="hidden" name="_token" value="'. csrf_token() . '">
                                <input class="dropdown-item" type="submit" value="Cancel Product" style="font-weight:500 !important;"> 
                                
                            </form>



                          </div>
                        </div>
                      
                ';
            }
            
        })
        

        ->make(true);   
    }

    public function printreceipt($id)
    {
        $order = Order::find($id);
        $user = User::where('email', $order->email)->first();


        $ta = new Transactionactivity;
        $ta->order_id = $id;
        $ta->user_id = $user->id;
        $ta->message = "Order receipt is printed and will be allocated to your package.";
        $ta->save();

        $order->status = "Receipt Printed";
        $order->save();

        Mail::to($order->email)->send(new ReceiptPrinted($order));

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'Your order is now ready for delivery. Thank you. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        // return $order->id;
        $orderitem = Orderitem::where('order_id', $order->id)->with('product')->get();

        $pdf = PDF::loadView('admin.receipt', array('order' => $order, 'orderitem' => $orderitem));
        return $pdf->stream( $order->id. '.pdf');
    }

    public function dispatch($id)
    {
        $order = Order::find($id);
        $user = User::where('email', $order->email)->first();

        if ($order->status != 'Receipt Printed') {
            return redirect()->back()->with('error', 'Please Print The Receipt First');
        }

        $ta = new Transactionactivity;
        $ta->order_id = $id;
        $ta->user_id = $user->id;
        $ta->message = "Your order is now being shipped, receipt is attached in the package.";
        $ta->save();

        $order->status = "Order Dispatched";
        $order->save();

        Mail::to($order->email)->send(new OrderDispatched($order));

        
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'Your order is now being shipped. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        return redirect()->back()->with('success', 'Successfully Dispatched Order');
    }

    public function fulfill($id)
    {
        $order = Order::find($id);
        $user = User::where('email', $order->email)->first();

        if ($order->status != 'Order Dispatched') {
            return redirect()->back()->with('error', 'This Order is not dispatched yet');
        }

        $ta = new Transactionactivity;
        $ta->order_id = $id;
        $ta->user_id = $user->id;
        $ta->message = "Your order is now fulfilled.";
        $ta->save();

        $order->status =  'Order FulFilled';
        $order->save();

        Mail::to($order->email)->send(new FulfillOrder($order));

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'Your order is now fulfilled. if you have any question please use our online chat Thank you. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        return redirect()->back()->with('success', 'Successfully Fulfill Order');
    }

    public function order_api()
    {
        // $orders = Order::where('status', 'For Verification')->where('purchase_type', '<>', 'Money Transfer')->get();
        $orders = Order::where('status', '<>', 'Pending Payment')->orderBy('created_at', 'asc')->get();
        return Datatables::of($orders)
        ->editColumn('customername', function($orders){
            return $orders->firstname . ' ' . $orders->lastname;
        })
        ->editColumn('id', function($orders){
            return str_pad($orders->id, 10, '0', STR_PAD_LEFT);
        })
        ->addColumn('action', function($orders){
            // $start = '<div class="dropdown">
            //           <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //             <i class="fa fa-cogs" aria-hidden="true"></i>
            //           </button>
            //           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
            
            // $end = '    <form action="/admin/transaction/order/item/' . $orders->id . '" method="get">
                            
            //                 <input type="hidden" name="_token" value="'. csrf_token() . '">
            //                 <input class="dropdown-item" type="submit" value="View Items" style="font-weight:500 !important;"> 
                            
            //             </form>
            //             <form action="/admin/transaction/order/delete/' . $orders->id . '" method="POST">
                            
            //                 <input type="hidden" name="_method" value="DELETE">
            //                 <input type="hidden" name="_token" value="'. csrf_token() . '">
            //                 <input class="dropdown-item" type="submit" value="Cancel Order" style="font-weight:500 !important;"> 
                            
            //             </form>
            //           </div>
            //         </div>';

            //         if ($orders->status == 'Order Received') {
            //             $start += '<form action="/admin/transaction/order/print/' . $orders->id . '" method="POST">
                            
            //                 <input type="hidden" name="_token" value="'. csrf_token() . '">
            //                 <input class="dropdown-item" type="submit" value="Print Receipt" style="font-weight:500 !important;"> 
                            
            //             </form>';
            //         }
            //         if ($orders->status == 'Receipt Printed') {
            //             $start += '<form action="/admin/transaction/order/dispatch/' . $orders->id . '" method="POST">
                            
            //                 <input type="hidden" name="_token" value="'. csrf_token() . '">
            //                 <input class="dropdown-item" type="submit" value="Dispatch Order" style="font-weight:500 !important;"> 
                            
            //             </form>';
            //         }
            //         if($order->status = 'Order Dispatched'){
            //             $start += '<form action="/admin/transaction/order/fulfill/' . $orders->id . '" method="POST">
                            
            //                 <input type="hidden" name="_token" value="'. csrf_token() . '">
            //                 <input class="dropdown-item" type="submit" value="Fullfill Order" style="font-weight:500 !important;"> 
                            
            //             </form>';
            //         }

            // return $start . $end;
            return '
                
                    <div class="dropdown">
                      <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <form action="/admin/transaction/order/print/' . $orders->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Print Receipt" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/dispatch/' . $orders->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Dispatch Order" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/fulfill/' . $orders->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Fullfill Order" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/item/' . $orders->id . '" method="get">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="View Order Items" style="font-weight:500 !important;"> 
                            
                        </form>
                        
                      </div>
                    </div>
                  
            ';
        })

        ->make(true);
    }

    public function delivery()
    {
        return "ok";
        return view('admin.delivery');
    }

    

    public function delivery_verify($id)
    {
        $order = Order::find($id);
        $orderitems = Orderitem::where('order_id', $order->id)->get();
        $isOk = true;
        foreach ($orderitems as $key => $item) {
            $product = Product::find($item->product_id);
            if($product->quantity < $item->quantity)
            {
                $isOk = false;
            }
        }
        if ($isOk) {
            foreach ($orderitems as $key => $item) {
                $sale = new Sale;
                $sale->product_id = $item->product_id;
                $sale->price = $item->subtotal / $item->quantity;
                $product = Product::find($item->product_id);
                $product->quantity -= 1;
                $product->save();
                $sale->save();
            }
            $order->delete();
            return redirect()->back()->with('success', 'Successfully Added To Sales');
        }
        else
        {
            return redirect()->back()->with('error', 'Not Enought Inventory');
        }
    }

    public function delivery_delete($id)
    {
        return "delete verify";
    }

    public function delivery_product($id)
    {
        return "ok";
    }

    public function delivery_product_api($id)
    {
        return "delivery product api";
    }
    public function delivery_api()
    {
        $orders = Order::where('status', 'Delivered')->get();
        return Datatables::of($orders)
        ->editColumn('customername', function($orders){
            return $orders->firstname . ' ' . $orders->lastname;
        })
        ->addColumn('action', function($orders){
            return '
                
                    <div class="dropdown">
                      <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                      </button>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <form action="/admin/transaction/order/verify/' . $orders->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Print Receipt" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/item/' . $orders->id . '" method="get">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="View Items" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/verify/' . $orders->id . '" method="POST">
                            
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Verify Order" style="font-weight:500 !important;"> 
                            
                        </form>
                        <form action="/admin/transaction/order/delete/' . $orders->id . '" method="POST">
                            
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'. csrf_token() . '">
                            <input class="dropdown-item" type="submit" value="Cancel Order" style="font-weight:500 !important;"> 
                            
                        </form>
                      </div>
                    </div>
                  
            ';
        })

        ->make(true);
    }


    // file maintenance
    public function moneytransfer()
    {
        return view('admin.moneytransfer');
    }

    public function moneytransfer_showcreate(Request $request)
    {
        return view('admin.moneytransfer_create');
    }

    public function moneytransfer_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'instruction' => 'required',
        ]);

        $moneytransfer = new Moneytransfer;
        $moneytransfer->name = $request->name;
        $moneytransfer->instruction = $request->instruction;
        $moneytransfer->save();

        return redirect()->to('/admin/filemaintenance/moneytransfer')->with('success', 'successfully created moneytransfer');
    }

    public function moneytransfer_showedit($id)
    {
        $moneytransfer = Moneytransfer::find($id);
        return view('admin.moneytransfer_edit')->withMoneytransfer($moneytransfer);
    }

    public function moneytransfer_edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'instruction' => 'required',
        ]);

        $moneytransfer = Moneytransfer::find($id);
        $moneytransfer->name = $request->name;
        $moneytransfer->instruction = $request->instruction;
        $moneytransfer->save();

        return redirect()->to('/admin/filemaintenance/moneytransfer')->with('success', 'Successfully edited moneytransfer');
    }

    public function moneytransfer_delete($id)
    {
        $moneytransfer = Moneytransfer::find($id);
        $moneytransfer->delete();
        return redirect()->back()->with('success', 'Successfully deleted moneytransfer');
    }

    public function moneytransfer_api()
    {
        $moneytransfers = Moneytransfer::all();

        return Datatables::of($moneytransfers)
        ->addColumn('instruction', function($moneytransfer){
            $nohtml = strip_tags($moneytransfer->instruction);
            return substr($nohtml, 0, 50) . ' . . . ';
        })
        ->addColumn('action', function($moneytransfers){
            return '
                <div class="dropdown">
                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/admin/filemaintenance/moneytransfer/edit/' . $moneytransfers->id . '">Edit</a>
                    <form id="delete" action="/admin/filemaintenance/moneytransfer/delete/' . $moneytransfers->id . '" method="POST">
                        
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input class="dropdown-item" type="submit" value="Delete" style="font-weight:500 !important;"> 
                        
                    </form>
                  </div>
                </div>
            ';
        })

        ->make(true);
    }

    public function customer()
    {
        return view('admin.customer');
    }

    public function customer_create(Request $request)
    {
        
    }

    public function customer_update($id, Request $request)
    {

    }

    public function customer_delete($id)
    {
        
    }

    public function showcase()
    {
        $showcases = Showcase::all();
        return view('admin.showcase')->withShowcase($showcases);
    }

    public function showcase_showcreate()
    {
        return view('admin.showcase_create');
    }

    public function showcase_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        

        if($request->hasFile('file'))
        {
            $banner = $request->file('file');
            $filename = time() . '_' . $banner->getClientOriginalName();
            Image::make($banner)->save( public_path('/images/showcasebanners/' . $filename) );

            $showcase = new Showcase;
            $showcase->name = ucwords($request->name);
            $showcase->description = ucwords($request->description);
            $showcase->banner = $filename;
            $showcase->save();

            return redirect()->to('/admin/filemaintenance/showcase')->with('success', 'Successfully added showcase');
        }

            return redirect()->back()->with('error', 'Failed to create Showcase');

    }

    public function showcase_showedit($id)
    {
        $showcase = Showcase::find($id);
        return view('admin.showcase_edit')->withShowcase($showcase);
    }

    public function showcase_edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $showcase = Showcase::find($id);
        $showcase->name = ucwords($request->name);
        $showcase->description = ucwords($request->description);

        if($request->hasFile('file'))
        {
            $banner = $request->file('file');
            $filename = time() . '_' . $banner->getClientOriginalName();
            Image::make($banner)->save( public_path('/images/showcasebanners/' . $filename) );
            $path = public_path() . '/images/showcasebanners/' . $showcase->banner;
            if(file_exists($path))
            { 
                unlink($path); 
            }
            $showcase->banner = $filename;
        }

        $showcase->save();
        return redirect()->to('/admin/filemaintenance/showcase')->with('success', 'Successfully updated showcase');
    }

    public function showcase_delete($id)
    {
        $showcase = Showcase::find($id);
        $path = public_path() . '/images/showcasebanners/' . $showcase->banner;
        if(file_exists($path))
        {
            unlink($path);
        }
        $showcase->delete();
        return redirect()->back()->with('success', 'Successfully deleted showcase');
    }

    public function showcase_addproduct($id)
    {
        $showcase = Showcase::find($id);
        return view('admin.showcase_addproduct')->withShowcase($showcase);
    }

    public function showcase_addproduct_create($showcaseid, $productid)
    {
        $showcaseitem = new Showcaseitem;
        $showcaseitem->showcase_id = $showcaseid;
        $showcaseitem->product_id = $productid; 
        $showcaseitem->save();
        return redirect()->back()->with('success', 'Successfully added to showcase');
    }

    public function showcase_addproduct_delete($id)
    {
        $showcaseitem = Showcaseitem::find($id);
        $showcaseitem->delete();
        return redirect()->back()->with('success', 'Successfully deleted showcase item');
    }

    public function showcase_api()
    {
        $showcases = Showcase::all();

        return Datatables::of($showcases)
        ->editColumn('banner', function($showcases){
            return '
                <img src="'. asset('images/showcasebanners/' . $showcases->banner) .'" style="height: 150px; width: 100%;">
            ';
        })
        ->editColumn('description', function($showcases){
            return substr($showcases->description, 0, 30) . ' . . . . .';
        })
        ->addColumn('action', function($showcases){
            return '
                <div class="dropdown">
                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/admin/filemaintenance/showcase/addproduct/' . $showcases->id . '">Add Products</a>
                    <a class="dropdown-item" href="/admin/filemaintenance/showcase/edit/' . $showcases->id . '">Edit</a>
                    <form id="delete" action="/admin/filemaintenance/showcase/delete/' . $showcases->id . '" method="POST">
        
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input class="dropdown-item" type="submit" value="Delete" style="font-weight:500 !important;"> 
                        
                    </form>
                  </div>
                </div>
            ';
        })
        ->rawColumns(['banner', 'action'])
        ->make(true);
    }

    public function showcase_product_api($id)
    {
        $showcaritemproductid = Showcaseitem::pluck('product_id');
        $products = Product::with('category', 'brand')->whereNotIn('id', $showcaritemproductid)->select(['products.*']);

        return Datatables::of($products)
        ->editColumn('price', function($products){
            if ($products->percent_off == 0) {
                return $products->price;
            }else{
                $percent_off_cash = ($products->percent_off / 100) * $products->price;

                return $products->price - $percent_off_cash;
            }
        })
        ->addColumn('action', function($products) use($id){
            return '
                
                    <form id="delete" action="/admin/filemaintenance/showcase/addproduct/create/' . $id . '/' . $products->id . '" method="POST">
                        
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input class="btn btn-primary btn-sm" type="submit" value=">" style="font-weight:500 !important;"> 
                        
                    </form>
                  
            ';
        })

        ->make(true);
    }

    public function showcase_item_api($id)
    {
        $showcaseitem = Showcaseitem::with('product')->select(['showcaseitems.*']);
        return Datatables::of($showcaseitem)
        ->addColumn('action', function($showcaseitem){
            return '
                
                    <form id="delete" action="/admin/filemaintenance/showcase/addproduct/delete/' . $showcaseitem->id . '" method="POST">
                        
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <input class="btn btn-primary btn-sm" type="submit" value="<" style="font-weight:500 !important;"> 
                        
                    </form>
                  
            ';
        })

        ->make(true);
    }

    public function brand()
    {
        return view('admin.brand');
    }

    public function brand_showcreate(Request $request)
    {
        return view('admin.brand_create');
    }

    public function brand_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $brand = new Brand;
        $brand->name = ucwords($request->name);
        $brand->description = $request->description;
        $brand->save();

        return redirect()->to('/admin/filemaintenance/brand')->with('success', 'Successfully added brand');
    }

    public function brand_showedit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand_edit')->withBrand($brand);
    }

    public function brand_edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $brand = Brand::find($id);
        $brand->name = ucwords($request->name);
        $brand->description = $request->description;
        $brand->save();

        return redirect()->to('/admin/filemaintenance/brand')->with('success', 'Successfully edited brand');
    }

    public function brand_delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Brand successfully deleted');
    }

    public function brand_api()
    {
        $brands = Brand::all();

        return Datatables::of($brands)
        ->addColumn('description', function($brands){
            $nohtml = strip_tags($brands->description);
            return substr($nohtml, 0, 50) . ' . . . ';
        })
        ->addColumn('action', function($brands){
            return '
                <div class="dropdown">
                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/admin/filemaintenance/brand/edit/' . $brands->id . '">Edit</a>
                    <form id="delete" action="/admin/filemaintenance/brand/delete/' . $brands->id . '" method="POST">
                        
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input class="dropdown-item" type="submit" value="Delete" style="font-weight:500 !important;"> 
                        
                    </form>
                  </div>
                </div>
            ';
        })

        ->make(true);
    }



    public function product()
    {
        $products = Product::all();
        return view('admin.product')->withProducts($products);
    }

    public function product_specification($id)
    {
        $product = Product::find($id);
        return view('admin.product_specification')->withProduct($product);
    }

    public function product_specification_create($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required',
        ]);

        $productspecification = new Productspecification;
        $productspecification->product_id = $id;
        $productspecification->name = ucwords($request->name);
        $productspecification->value = ucwords($request->value);
        $productspecification->save();

        return redirect()->back()->with('success', 'Successfully added a specification');
    }

    public function product_specification_edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required',
        ]);

        $productspecification = Productspecification::find($id);
        $productspecification->name = ucwords($request->name);
        $productspecification->value = ucwords($request->value);
        $productspecification->save();

        return redirect()->back()->with('success', 'Successfully updated a specification');
    }

    public function product_specification_delete($id)
    {
        $specification = Productspecification::find($id);
        $specification->delete();
        return redirect()->back()->with('success', 'Successfully deleted specification');
    }

    public function product_specification_api($id)
    {
        $products = Product::find($id);
        return Datatables::of($products->productspecification)
        ->addColumn('action', function($specification){
            return '
                <div class="dropdown">
                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#specificationeditmodal' . $specification->id . '">Edit</a>

                    <form id="delete" action="/admin/filemaintenance/product/specification/delete/' . $specification->id . '" method="POST">
                        
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input class="dropdown-item" type="submit" value="Delete" style="font-weight:500 !important;"> 
                        
                    </form>
                  </div>
                </div>
            ';
        })

        ->make(true);

    }

    public function product_image($id)
    {
        $product = Product::find($id);
        return view('admin.product_image')->withProduct($product);
    }

    public function product_image_upload($id, Request $request)
    {
        foreach ($request->file as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            Image::make($file)->save( public_path('/images/productimages/' . $filename) );
            $productimage = new Productimage;
            $productimage->product_id = $id;
            $productimage->name = $filename;
            $productimage->save();
        }

        return redirect()->back()->with('success', 'Successfully uploaded image');
    }

    public function product_image_delete($id)
    {
        $productimage = Productimage::find($id);
        $path = public_path() . '/images/productimages/' . $productimage->name;
        if(file_exists($path))
        {
            unlink($path);
        }
        
        $productimage->delete();

        return redirect()->back()->with('success', 'Successfully deleted image');
    }

    public function product_showcreate()
    {
        return view('admin.product_create');
    }

    public function product_create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:15',
            'quantity' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $product = new Product;
        $product->name = ucwords($request->name);
        $product->init_qty = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->description = $request->description;
        $product->save();

        


        foreach ($request->file as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            Image::make($file)->save( public_path('/images/productimages/' . $filename) );
            $productimage = new Productimage;
            $productimage->product_id = $product->id;
            $productimage->name = $filename;
            $productimage->save();
        }

        return redirect()->to('/admin/filemaintenance/product')->with('success', 'Product successfully created');
    }

    public function product_showedit($id)
    {
        $product = Product::find($id);
        return view('admin.product_edit')->withProduct($product);
    }

    public function product_edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);


        $product = Product::find($id);
        $product->name = ucwords($request->name);
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->description = $request->description;
        $product->save();

        return redirect()->to('/admin/filemaintenance/product')->with('success', 'Product successfully edited');
    }

    public function product_percentoff_edit($id, Request $request)
    {
        $this->validate($request, [
            'percent_off' => 'required',
        ]);

        $product = Product::find($id);
        $product->percent_off = $request->percent_off;
        $product->save();

        return redirect()->back()->with('success', 'Successfully Updated Percent Off');
    }

    public function product_delete($id)
    {
        $product = Product::find($id);
        $productimages = Productimage::where('product_id', $id)->get();
        foreach ($productimages as $image) {
            $path = public_path() . '/images/productimages/' . $image->name;
            if(file_exists($path))
            {
                unlink($path);
            }
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted');
    }

    public function product_api()
    {
        $products = Product::with('category', 'brand', 'productimage')->select(['products.*']);

        return Datatables::of($products)
        ->editColumn('description', function($products){
            $nohtml = strip_tags($products->description);
            return substr($nohtml, 0, 50) . ' . . . ';
        })
        ->editColumn('price', function($products){
            if ($products->percent_off == 0) {
                return $products->price;
            }else{
                $percent_off_cash = ($products->percent_off / 100) * $products->price;

                return $products->price - $percent_off_cash;
            }
        })
        ->addColumn('action', function($products){
            return '
                <div class="dropdown">
                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#replenish' . $products->id . '">Replenish Product</a>
                    <a class="dropdown-item" href="/admin/filemaintenance/product/specification/' . $products->id . '">Specifications</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#percentoffmodal' . $products->id . '">Percent Off</a>
                    <a class="dropdown-item" href="/admin/filemaintenance/product/image/' . $products->id . '">Images</a>
                    <a class="dropdown-item" href="/admin/filemaintenance/product/edit/' . $products->id . '">Edit</a>
                    <form id="delete" action="/admin/filemaintenance/product/delete/' . $products->id . '" method="POST">
                        
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="'. csrf_token() . '">
                        <input class="dropdown-item" type="submit" value="Delete" style="font-weight:500 !important;"> 
                        
                    </form>
                    
                  </div>
                </div>
            ';
        })

        ->make(true);
    }

    public function product_replenish(Request $request, $id)
    {
        $product = Product::find($id);
        $product->init_qty += $request->init_qty;
        $product->save();
        return redirect()->back()->with('success','Successfully Updated Initial Quantity');
    }

    

    

    // end file maintenance



}
