<html>
<head>
<title>Your Item is Ready For Shippment</title>

<style>
* {font: 15px arial}

</style>

<body>

<p>Dear {{$order->firstname . ' ' . $order->lastname}},</p>
	<p>Order # {{str_pad($order->id, 10, '0', STR_PAD_LEFT)}}<br>

		<p>Your order is now Fulfill. Thank you for choosing Techshop28</p><br>

<p>

		Customer Information	<br>
	</p>
			<p>{{$order->firstname . ' ' . $order->lastname}}<br>
			Cell Number: {{$order->mobilenumber}}<br>
			Email: {{$order->email}}
</p>
<body>
<html>