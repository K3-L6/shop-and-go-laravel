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
#meta td.meta-order{ text-align:left; background: #eee; }
#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { text-align:left;background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

	</style>
<body>
	<div id="page-wrap">

		<div  id="header">Official Receipt</div>
		
		<div id="identity">
		
<div >
	<Center>
	<h1>TECHSHOP28<h1> 
		<h4 style= "font: 15px arial">1546 Plaza Pedro Space Rental, Taft Avenue Malate Manila</h4>
			<h4 style= "font: 15px arial">Contact No : 09198991168 / 09193213333</h4>
	</div>

	<br></br>
			
			<h4 style="text-align: right;padding-right: 60px;font: 15px arial" ">Order ID : {{str_pad($order->id, 10, '0', STR_PAD_LEFT)}}</h4>
			<h4 style= "font: 15px arial">Customer Name : {{$order->firstname . ' ' . $order->lastname}}</h4>
			<br></br>
			<br><br>
			<h4 style= "font: 15px arial;">Customer Address : {{$order->address . ', ' . $order->province}}</h4>            
		<div style="clear:both"></div>
		<br><br>
			<h4 style="text-align: right;padding-right: 60px ;font: 15px arial">Date : {{date('m/d/Y', time())}} </h4>
		<table id="items">
		
		  <tr>
		  	
		      <th>Product Name</th>
		      <th>Brand</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
			
		@foreach ($orderitem as $item)
			<tr class="item-row">
			    <td class="item-name">{{$item->product->name}}</td>
			    <td class="description">{{$item->product->brand->name}}</td>
			    <td class="cost">{{$item->product->price}}</textarea></td>
			    <td class="qty">{{$item->quantity}}</td>
			    <td><span class="price">{{$item->subtotal}}</span></td>
			</tr>
		@endforeach
		  
		


		  <tr class="item-row">

		  	<td></td>
		  	<td></td>
		  	<td></td>
		  	<td  style="border-top: 1px solid black;">
		  		Sub Total :
		  	</td>
		  	<td  style="border-top: 1px solid black;">
		  		{{$order->total - $order->shipping_fee}}
		  	</td>

		  </tr>
		  <tr class="item-row">
		  	<td></td>
		  	<td></td>
		  	<td></td>
		  	<td>
		  		Shipping Fee :
		  	</td>
		  	<td>
		  		{{$order->shipping_fee}}
		  	</td>

		  </tr>   
		<tr class="item-row">
		  	<td></td>
		  	<td></td>
		  	<td></td>
		  	<td>
		  		Total :
		  	</td>
		  	<td> 
		  		{{$order->total}}
		  	</td>

		  </tr>   
		
		</table>

			
	</div>
	</div>
</body>

</html>