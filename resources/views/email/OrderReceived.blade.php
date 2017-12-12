<html>
<head>
<title></title>

</head>
<style>
* {font: 15px arial}

</style>

<body>
<h4>Dear {{$order->firstname . ' ' . $order->lastname}},</h4>
<p>Your Order # {{str_pad($order->id, 10, '0', STR_PAD_LEFT)}} has been placed on {{date('m/d/Y', time())}} via {{$order->purchase_type}}.</p>

<h3>Note:</h3>
	<p>In the event that the information you provided is incomplete, a validation may be sent through 
		sms as part of TechShop28 order verification requirement.</p>

<p>TechShop28 will never ask you to send cash or deposit money to any personal bank account or remittance centers. As a general precaution, do not give out your bank account/credit card details or any personal information to anyone who claims to be TechShop28 representative not using our official channels of communication.</p>

<p>Order validations will be conducted between 8am and 9pm, from Monday to Sunday. Failure to respond to either call or SMS will result in order cancellation/s.</p>

{{-- <p>
This order will arrive by:<br>
Shipment # 1: 30 Aug - 02 Sep, 2017<br><br>
</p> --}}
{{-- <p>Your Order will be delivered to:<br>
Wilson Marasigan<br>
8th Floor Rufino Tower Ayala Avenue Metro Manila~Makati-Makati City-Bel~air <br>
Phone: 9272443309<br>
<br> --}}

Order details:<br><br>
@foreach ($orderitem as $item)
	Product Name {{$item->product->name}}<br>
	Quantity {{$item->quantity}}<br>
	Price {{$item->subtotal}}<br><br>
@endforeach
<br><br>

Subtotal:	₱ {{$order->total - $order->shipping_fee}}<br>
Shipping fee:	₱ {{$order->shipping_fee}}<br>
Total:	₱ {{$order->total}}	<br>
VAT applied where applicable
</p>


</body>

</body>

</html>