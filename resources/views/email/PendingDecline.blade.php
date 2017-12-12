<html>
<head>
<title>Money Transfer Instruction</title>

<style>
* {font: 15px arial}

</style>

<body>

<p>Dear {{$order->firstname . ' ' . $order->lastname}},</p>
	<p>Order # {{str_pad($order->id, 10, '0', STR_PAD_LEFT)}}<br>

		<p>Your payment throught {{$moneytransfer->name}} has been decline.
		Please try to upload a new receipt.</p><br>
		
		

<p>

		Customer Information	<br>
	</p>
			<p>{{$order->firstname . ' ' . $order->lastname}}<br>
			Cell Number: {{$order->mobilenumber}}<br>
			Email: {{$order->email}}
</p>
<body>
<html>