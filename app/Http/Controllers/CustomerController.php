<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

//modeks
use App\Product;
use App\Cart;
use App\Cartitem;
use App\User;
use App\Order;
use App\Orderitem;
use App\City;
use App\Province;
use App\Moneytransfer;
use App\Moneytransferpending;
use App\Review;
use App\Showcase;
use App\Showcaseitem;
use App\Transactionactivity;
use App\Cancelproductrequest;
use App\Returnproductrequest;
use App\Productspecification;
use App\Wishlist;
use Session;

use Image;

use Nexmo\Laravel\Facade\Nexmo;

use DB;
use Mail;
use App\Mail\OrderReceived;
use App\Mail\SendMoneytransferInstruction;
use App\Mail\PendingVerification;
use App\Mail\CancelRequest;
use App\Mail\ReturnRequest;
//packages

class CustomerController extends Controller
{
    public function changeinfo(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'mobilenumber' => 'required|regex:/(09)[0-9]{9}/',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::find(Auth::user()->id);
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->mobilenumber = $request->mobilenumber;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'Successfully Updated Info');
    }
    public function review($id, Request $request)
    {
        $reviews = Review::where('user_id', Auth::user()->id)->where('product_id', $id)->get();
        if(count($reviews) != 0)
        {
            return redirect()->back()->with('error', 'You have already reviewed this item');
        }
        $review = new Review;
        $review->user_id = Auth::user()->id;
        $review->product_id = $id;
        $review->content = $request->content;
        $review->save();
        return redirect()->back()->with('success', 'Successfully Added a Review');
        
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function transaction()
    {
        $orders = Order::where('email', Auth::user()->email)->where('status', '<>', 'Pending Payment')->orderBy('created_at', 'desc')->get();
        $pendingorders = Order::where('status', 'Pending Payment')->orderBy('created_at', 'desc')->get();
        // $cancelrequest = Cancelrequest::orderBy('created_at', 'desc')->get();
        $cpr = Cancelproductrequest::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        $rpr = Returnproductrequest::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('customer.transaction')->withOrders($orders)->withPendingorders($pendingorders)->withCpr($cpr)->withRpr($rpr);
    }

    public function manageorder($id)
    {
        $order = Order::find($id);
        $orderitems = Orderitem::where('order_id', $id)->with('product', 'product.productimage')->get();
        $orderstatus = $order->status;
        $ordershippingfee = $order->shipping_fee;
        $ordertotal = $order->total;


        $ta = Transactionactivity::where('order_id', $id)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();



        return view('customer.manageorder')->withOrderitems($orderitems)->withOrderstatus($orderstatus)->withOrdershippingfee($ordershippingfee)->withOrdertotal($ordertotal)->withTa($ta);
    }

    public function cancelproductrequest($id, Request $request)
    {
        $this->validate($request, [
            'reason' => 'required',
        ]);

        $orderitem = Orderitem::find($id);
        $order = Order::find($orderitem->order_id);

        $ta = new Transactionactivity;
        $ta->order_id = $order->id;
        $ta->user_id = Auth::user()->id;
        $ta->message = "We received your product cancellation for order item id " . $orderitem->id;
        $ta->save();

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr(Auth::user()->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'We received your product cancellation request for order item id ' . $orderitem->id. ' Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        Mail::to(Auth::user()->email)->send(new CancelRequest($order, $orderitem));

        $cpr = new Cancelproductrequest;
        $cpr->user_id = Auth::user()->id;
        $cpr->orderitem_id = $orderitem->id;
        $cpr->reason = $request->reason;
        $cpr->save();

        return redirect()->back()->with('success', 'Successfully requested product cancellation');
    }

    public function returnproductrequest($id, Request $request)
    {
        $this->validate($request, [
            'reason' => 'required',
        ]);

        $orderitem = Orderitem::find($id);
        $order = Order::find($orderitem->order_id);

        $ta = new Transactionactivity;
        $ta->order_id = $order->id;
        $ta->user_id = Auth::user()->id;
        $ta->message = "We received your request for product return for order item id " . $orderitem->id;
        $ta->save();

        Mail::to(Auth::user()->email)->send(new ReturnRequest($order, $orderitem));

        $rpr = new Returnproductrequest;
        $rpr->user_id = Auth::user()->id;
        $rpr->orderitem_id = $orderitem->id;
        $rpr->reason = $request->reason;
        $rpr->save();

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr(Auth::user()->mobilenumber, 1, 10),
            'from' => '639122037947',
            'text' => 'We received your product return request for order item id ' . $orderitem->id. ' Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        

        return redirect()->back()->with('success', 'Successfully requested product return');
    }

    public function uploadreceipt(Request $request, $id)
    {
        if(!$request->hasFile('receipt'))
        {
            return redirect()->back()->with('error', 'No Image Selected');
        }

        $order = Order::find($id);
        $mtp = new Moneytransferpending;
        $mtp->moneytransfer_id = $order->moneytransfer_id;
        $mtp->order_id = $id;



        $receipt = $request->file('receipt');
        $filename = time() . '_' . $receipt->getClientOriginalName();
        Image::make($receipt)->save( public_path('/images/receipts/' . $filename) );

        $mtp->receipt = $filename;
        $mtp->save();     

        $ta = new Transactionactivity;
        $ta->order_id = $order->id;
        $ta->user_id = Auth::user()->id;
        $ta->message = "We are verifying your uploaded payment details.";
        $ta->save();

        $order->status  = 'Payment Verification';
        $order->save();

        $moneytransfer = Moneytransfer::find($order->moneytransfer_id);
        Mail::to(Auth::user()->email)->send(new PendingVerification($order, $moneytransfer));

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '63' . substr($order->mobilenumber, 1, 10),
            'from' => '639356040507',
            'text' => 'We are now verifying your payment. Thank you. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        ]);

        // $nexmo = app('Nexmo\Client');
        // $nexmo->message()->send([
        //     'to' => '63' . substr($order->mobilenumber, 1, 10),
        //     'from' => '639356040507',
        //     'text' => 'We Receive your order via Money Transfer and Email you all the necessary instruction. Order ID: '. $order->id . 'This is from Techshop 28' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
        // ]);

        return redirect()->back()->with('success', 'Successfully Uploaded Receipt, Please wait for our email for updates');
    }

    public function cancelrequest($id, Request $request)
    {
        $this->validate($request, [
            'reason' => 'required',
        ]);

        $order = Order::find($id);

        $ta = new Transactionactivity;
        $ta->order_id = $order->id;
        $ta->user_id = Auth::user()->id;
        $ta->message = "We received your order cancellation.";
        $ta->save();

        //send email here

        //send sms here

        $cancelrequest = new Cancelrequest;
        $cancelrequest->user_id = Auth::user()->id;
        $cancelrequest->order_id = $order->id;
        $cancelrequest->reason = $request->reason;
        $cancelrequest->save();

        return redirect()->back()->with('success', 'Successfully requested order cancellation');
    }

    public function wishlist()
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please Register Account');
        }
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('customer.wishlist')->withWishlist($wishlist);
    }

    public function addtowishlist($id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please Register Account');
        }
        $product = Product::find($id);
        $user = User::find(Auth::user()->id);

        $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
        if ($wishlist != NULL) {
            return redirect()->back()->with('error', 'This product is already in your wishlist');
        }

        $newwishlist = new Wishlist;
        $newwishlist->user_id = $user->id;
        $newwishlist->product_id = $product->id;
        $newwishlist->save();

        return redirect()->to('/')->with('success', 'Successfully added to Wishlist');
    }

    public function removewishlist($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect()->back()->with('success', 'Successfully Removed Product');
    }


    public function product_display($sort)
    {
    	switch ($sort) {
    		case 'headphones':
    			$products = Product::where('category_id', 1)->with('productimage')->paginate(12);
    			return view('customer.product')->withProducts($products)->with('category', $sort);
    			break;

            case 'speakers':
                $products = Product::where('category_id', 2)->with('productimage')->paginate(12);
                return view('customer.product')->withProducts($products)->with('category', $sort);
                break;

            case 'digitalaudioplayer':
                $products = Product::where('category_id', 3)->with('productimage')->paginate(12);
                return view('customer.product')->withProducts($products)->with('category', $sort);
                break;

            case 'accessories':
                $products = Product::where('category_id', 4)->with('productimage')->paginate(12);
                return view('customer.product')->withProducts($products)->with('category', $sort);
                break;
    		
    		default:
    		    
    			break;
    	}
    }

    public function product_search(Request $request)
    {
        $products = Product::whereHas('brand', function ($query) use ($request){
            $query->where('name', 'like', '%'. $request->search . '%');
        })
        ->orWhereHas('category', function ($query) use ($request){
            $query->where('name', 'like', '%'. $request->search . '%');
        })
        ->orWhereHas('productspecification', function ($query) use ($request){
            $query->where('value', 'like', '%'. $request->search . '%');
        })
        ->orWhere ('description', 'like', '%'. $request->search . '%')
        ->orWhere ('name', 'like', '%'. $request->search . '%')

        ->get();

        // $products = Product::where('name', 'like', '%'. $request->search . '%')
        // ->orWhere ('description', 'like', '%'. $request->search . '%')
        // ->orWhere ('brand_id', 'like', '%'. $request->search . '%')
        // ->with('productimage')->paginate(12);
        return view('customer.product_search')->withProducts($products)->with('category', $request->search);
    }

    public function product_showcase_display($id)
    {
        $showcase = Showcase::find($id);
        $showcaseitem = Showcaseitem::where('showcase_id',  $showcase->id)->get();
        return view('customer.product_showcase')->withShowcaseitem($showcaseitem)->with('showcase', $showcase->name);
    }

    public function product_single_display($id)
    {
        $product = Product::find($id);
        return view('customer.product_single')->withProduct($product);
    }

    public function addtocart($productid)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please Register Account');
        }

        $product = Product::find($productid);

        //create cart object if absent in database
        $usercart = Cart::where('user_id', Auth::user()->id)->first();
        if($usercart == null)
        {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }

        //add to cart
        $user = User::find(Auth::user()->id)->with('cart')->get();
        $usercartid;
        $usercarttotal;
        foreach ($user as $user) {
            foreach ($user->cart as $cart) {
                $usercartid = $cart->id;
                $usercarttoal = $cart->total;
            }
        }

        //check if product is already in your cart return error if existing
        $cartitemcheck = Cartitem::where('product_id', $productid)->where('cart_id', $usercartid)->first();
        if($cartitemcheck != null)
        {
            return redirect()->back()->with('error', 'This product is already in your cart');
        }

        
        if($product->percent_off != 0)
        {
            $cartitem = new Cartitem;
            $cartitem->cart_id = $usercartid;
            $cartitem->product_id = $productid;
            $cartitem->quantity = 1;
            $percent_off_cash = ($product->percent_off / 100) * $product->price;
            $cartitem->subtotal =  $product->price - $percent_off_cash;
            $cartitem->save(); 
        }
        else
        {
            $cartitem = new Cartitem;
            $cartitem->cart_id = $usercartid;
            $cartitem->product_id = $productid;
            $cartitem->quantity = 1;
            $cartitem->subtotal = $product->price;
            $cartitem->save();   
        }
        
        

        //update total in cart parent
        
        if($product->percent_off != 0)
        {
            $cart = Cart::find($usercartid);
            $percent_off_cash = ($product->percent_off / 100) * $product->price;
            $cart->total +=  $product->price - $percent_off_cash;
            $cart->save();
        }
        else
        {
            $cart = Cart::find($usercartid);
            $cart->total += $product->price;
            $cart->save();
        }
        
        return redirect()->to('/cart')->with('success', 'Successfully Added To Your Cart');
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please Register Account');
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartitems = Cartitem::where('cart_id', $cart->id)->get();

        if ($cart->total == 0) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        //check stock
        foreach ($cartitems as $key => $item) {
            $inventorylist = DB::table('v_inventory')->where('product_id', $item->product_id)->first();
            if ($inventorylist == NULL) {
                $product = Product::find($item->product_id);
                if($item->quantity > $product->init_qty)
                {
                    return redirect()->back()->with('error', 'Not Enough Stock For ' . $product->name);
                }
            }else{
                $product = Product::find($item->product_id);
                if($item->quantity > $inventorylist->qty)
                {
                    return redirect()->back()->with('error', 'Not Enought Stock For ' . $product->name);    
                }
            }
        }

        return view('customer.checkout')->withCart($cart)->withCartitems($cartitems);
    }

    public function payment(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required',
            'address' => 'required',
            'province' => 'required',
            'mobilenumber' => 'required|regex:/(09)[0-9]{9}/',
        ]);

        $userinfo = array(
            'lastname' => $request->lastname , 
            'firstname' => $request->firstname , 
            'address' => $request->address , 
            'province' => $request->province ,
            'mobilenumber' => $request->mobilenumber , 
            'email' => $request->email ,
            'shippingfee' => Province::find($request->province)->shipping_fee,
        );

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartitems = Cartitem::where('cart_id', $cart->id)->get();

        return view('customer.payment')->withUserinfo($userinfo)->withCart($cart)->withCartitems($cartitems);
    }

    public function forward2c2p(Request $request)
    {
        return view('customer.2c2p');
    }

    public function postfinish(Request $request)
    {
        $paymenttype = $request->paymenttype;
        switch ($paymenttype) {
            case 'moneytransfer':
                
                $user = User::where('email', $request->email)->first();
                $cart = Cart::where('user_id', $user->id)->first();
                $cartitems = Cartitem::where('cart_id', $cart->id)->get();
                
                $order = new Order;
                $order->firstname = $request->firstname;
                $order->lastname = $request->lastname;
                $order->email = $request->email;
                $order->mobilenumber = $request->mobilenumber;
                $order->province = $request->province;
                $order->address = $request->address;
                $order->shipping_fee = $request->shippingfee;
                $order->total = $cart->total + $request->shippingfee;
                $order->moneytransfer_id = $request->moneytransfers;
                $order->purchase_type = "Money Transfer";
                $order->status = "Pending Payment";
                $order->save();

                $ta = new Transactionactivity;
                $ta->order_id = $order->id;
                $ta->user_id = Auth::user()->id;
                $ta->message = "We received your order via moneytransfer.";
                $ta->save();

                // send instruction through email here
                $moneytransfer = Moneytransfer::find($order->moneytransfer_id);
                Mail::to(Auth::user()->email)->send(new SendMoneytransferInstruction($order, $moneytransfer));

                $nexmo = app('Nexmo\Client');
                $nexmo->message()->send([
                    'to' => '63' . substr(Auth::user()->mobilenumber, 1, 10),
                    'from' => '639356040507',
                    'text' => 'We Receive your order via Money Transfer and Email you all the necessary instruction. Order ID: '. $order->id . 'This is from Techshop 28' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
                ]);

                
                foreach ($cartitems as $cartitem) {
                    $orderitemcount = $cartitem->quantity;
                    for($x = 0; $x < $orderitemcount; $x++)
                    {
                        $orderitem = new Orderitem;
                        $orderitem->order_id = $order->id;
                        $orderitem->product_id = $cartitem->product->id;
                        $orderitem->quantity = 1;
                        $orderitem->subtotal = $cartitem->subtotal;
                        $orderitem->save();    
                    }
                }


                $cart->delete();

                $newcart = new Cart;
                $newcart->user_id = $user->id;
                $newcart->total = 0;
                $newcart->save();


                return redirect()->to('/')->with('success', 'Your Order has been placed Check the transaction section for update');
                break;

            case 'creditcart':

                $user = User::where('email', $request->email)->first();
                $cart = Cart::where('user_id', $user->id)->first();
                $cartitems = Cartitem::where('cart_id', $cart->id)->get();
               
               
                $order = new Order;
                $order->firstname = $request->firstname;
                $order->lastname = $request->lastname;
                $order->email = $request->email;
                $order->mobilenumber = $request->mobilenumber;
                $order->province = $request->province;
                $order->address = $request->address;
                $order->shipping_fee = $request->shippingfee;
                $order->total = $cart->total + $request->shippingfee;
                $order->purchase_type = "Credit Card";
                $order->status = "Order Received";
                $order->save();

                $ta = new Transactionactivity;
                $ta->order_id = $order->id;
                $ta->user_id = Auth::user()->id;
                $ta->message = "We received your order via Credit Card.";
                $ta->save();
                
                foreach ($cartitems as $cartitem) {
                    $orderitemcount = $cartitem->quantity;
                    for($x = 0; $x < $orderitemcount; $x++)
                    {
                        $orderitem = new Orderitem;
                        $orderitem->order_id = $order->id;
                        $orderitem->product_id = $cartitem->product->id;
                        $orderitem->quantity = 1;
                        $orderitem->subtotal = $cartitem->subtotal / $orderitemcount;
                        $orderitem->save();    
                    }
                }


                $cart->delete();

                $newcart = new Cart;
                $newcart->user_id = $user->id;
                $newcart->total = 0;
                $newcart->save();

                $orderitem = Orderitem::where('order_id', $order->id)->with('product')->get();

                Mail::to(Auth::user()->email)->send(new OrderReceived($order, $orderitem));


                $nexmo = app('Nexmo\Client');
                $nexmo->message()->send([
                    'to' => '63' . substr(Auth::user()->mobilenumber, 1, 10),
                    'from' => '639122037947',
                    'text' => 'We received your order via Credit Card. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
                ]);  

                return view('customer.2c2p')->withOrder($order);
                // return redirect()->to('/2c2p');

                break;

            default:

                $user = User::where('email', $request->email)->first();
                $cart = Cart::where('user_id', $user->id)->first();
                $cartitems = Cartitem::where('cart_id', $cart->id)->get();
               
                $order = new Order;
                $order->firstname = $request->firstname;
                $order->lastname = $request->lastname;
                $order->email = $request->email;
                $order->mobilenumber = $request->mobilenumber;
                $order->province = $request->province;
                $order->address = $request->address;
                $order->shipping_fee = $request->shippingfee;
                $order->total = $cart->total + $request->shippingfee;
                $order->purchase_type = "Cash On Delivery";
                $order->status = "Order Received";
                $order->save();

                $ta = new Transactionactivity;
                $ta->order_id = $order->id;
                $ta->user_id = Auth::user()->id;
                $ta->message = "We received your order via cod.";
                $ta->save();
                
                foreach ($cartitems as $cartitem) {
                    $orderitemcount = $cartitem->quantity;
                    for($x = 0; $x < $orderitemcount; $x++)
                    {
                        $orderitem = new Orderitem;
                        $orderitem->order_id = $order->id;
                        $orderitem->product_id = $cartitem->product->id;
                        $orderitem->quantity = 1;
                        $orderitem->subtotal = $cartitem->subtotal / $orderitemcount;
                        $orderitem->save();    
                    }
                }


                $cart->delete();

                $newcart = new Cart;
                $newcart->user_id = $user->id;
                $newcart->total = 0;
                $newcart->save();

                $orderitem = Orderitem::where('order_id', $order->id)->with('product')->get();
                
                Mail::to(Auth::user()->email)->send(new OrderReceived($order, $orderitem));


                $nexmo = app('Nexmo\Client');
                $nexmo->message()->send([
                    'to' => '63' . substr(Auth::user()->mobilenumber, 1, 10),
                    'from' => '639122037947',
                    'text' => 'We received your order via Cash On Delivery. Order ID : ' . $order->id . ' This is from Techshop28 ' . date("d-m-y", time()) . ' ' . date("h:i A.", time())
                ]);

                return redirect()->to('/')->with('success', 'Your Order has been placed Check the transaction section for update');
                break;

        }
    }

    public function findmoneytransfers(Request $request)
    {
        $data = Moneytransfer::select('instruction', 'id')->where('id', $request->id)->get();
        return response()->json($data);
    }

    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please Register Account');
        }

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $inventory = DB::table('v_inventory');
        $cartitems = Cartitem::where('cart_id', $cart->id)->with('product', 'product.productimage')->get();
        
        // return $time;
        return view('customer.cart')->withCartitems($cartitems)->withCart($cart);
    }

    public function cartrefresh($id, Request $request)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartitem = Cartitem::where('id', $id)->first();
        $product = Product::where('id', $cartitem->product_id)->first();

        $quantity = $request->quantity;
        $quantityoriginal = $cartitem->quantity;


        if($product->percent_off != 0)
        {
            $percent_off_cash = ($product->percent_off / 100) * $product->price;
            $productprice =  $product->price - $percent_off_cash;
            $cart->total -= $quantityoriginal * $productprice;
            $cart->save();
        }
        else
        {
            $cart->total -= $quantityoriginal * $product->price;
            $cart->save();    
        }
        


        if($product->percent_off != 0)
        {
            $percent_off_cash = ($product->percent_off / 100) * $product->price;
            $productprice =  $product->price - $percent_off_cash;
            $cartitem->subtotal = $quantity * $productprice;
            $cartitem->quantity = $quantity;
            $cartitem->save();    
        }
        else
        {
            $cartitem->subtotal = $quantity * $product->price;
            $cartitem->quantity = $quantity;
            $cartitem->save();    
        }
        

        if($product->percent_off != 0)
        {
            $percent_off_cash = ($product->percent_off / 100) * $product->price;
            $productprice =  $product->price - $percent_off_cash;
            $cart->total += $quantity * $productprice;
            $cart->save();
        }
        else
        {
            $cart->total += $quantity * $product->price;
            $cart->save();    
        }
        

        return redirect()->back()->with('success', 'Successfully Updated Cart');
    }

    public function cartdelete($id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $cartitem = Cartitem::where('id', $id)->first();
        $product = Product::where('id', $cartitem->product_id)->first();
        
        if($product->percent_off != 0)
        {
            $percent_off_cash = ($product->percent_off / 100) * $product->price;
            $productprice =  $product->price - $percent_off_cash;

            $quantity = $cartitem->quantity;
            $cart->total -= $quantity * $productprice;
            $cart->save();
            $cartitem->delete();
        }
        else
        {
            $quantity = $cartitem->quantity;
            $cart->total -= $quantity * $product->price;
            $cart->save();
            $cartitem->delete();    
        }
        


        return redirect()->back()->with('success', 'Product Removed');
    }
}
