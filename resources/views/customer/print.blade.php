{{-- <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1 style="border: 1px solid black; text-align: center; padding: 5%;">TECHSHOP28 RECEIPT</h1>
	<h3 style="border: 1px solid black; padding-left: 2%; ">Customer Name : {{$order->firstname}} {{$order->lastname}}</h3>
	<h3 style="border: 1px solid black; padding-left: 2%;">Province : {{$order->province}}</h3>
	<h3 style="border: 1px solid black; padding-left: 2%;">City : {{$order->city}}</h3>
	<h3 style="border: 1px solid black; padding-left: 2%;">Address : {{$order->address}}</h3>
	<table class="table" style="width: 100%;  border: 1px solid black;">
		<thead style="border-bottom: 1px solid black">
			<tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>SubTotal</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orderitem as $item)
				<tr>
					<td>{{$item->product->name}}</td>
					<td>{{$item->quantity}}</td>
					<td>{{$item->subtotal}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<h3 style="border: 1px solid black; text-align: right; padding-rifht: 2%;">Total : {{$order->total}}</h3>

</body>
</html> --}}




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<!--<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
-->
</head>
<style>
	

* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

	</style>
<body>

	<div id="page-wrap">

		<textarea id="header">Official Receipt</textarea>
		
		<div id="identity">
		
<div>
	<Center>
	<h1>TECHSHOP28<h1>
		<h2>
	</div>
</center>
			<p>Customer Name</p>
			

			<br></br>

			<p>Customer Address</p>            
		<div style="clear:both"></div>
		
		<div id="customer">

            <table id="meta">
                <tr>

                    <td class="meta-head">Date</td>
                   	 <td><textarea id="date">December 15, 2009</textarea></td>
                </tr>
            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Product Name</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name">#</td>
		      <td class="description">#</td>
		      <td class="cost">#</textarea></td>
		      <td class="qty">#</td>
		      <td><span class="price">#</span></td>
		  </tr>
		  		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">#</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Shipping Fee</td>
		      <td class="total-value"><div id="total">#</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><textarea id="paid">#</textarea></td>
		  </tr>
		  
		</table>
		
		
	
	</div>
	
</body>

</html>