<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>
		To Verify email <a href="{{ route('sendEmailDone', ["email" => $user->email, "verifyToken" => $user->verifyToken]) }}">click here</a>	
	</h1>
		
</body>
</html>







