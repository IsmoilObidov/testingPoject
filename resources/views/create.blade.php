<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<form id="whois-lookup-form" action="" method="POST">
		{{ method_field('POST') }}
		{{ csrf_field() }}
		<div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">

			<label for="domain">Domain</label>
			<input name="domain" type="text" class="form-control" placeholder="Domain name">

			@if ($errors->has('domain'))
				<span class="help-block">
					<strong>{{ $errors->first('domain') }}</strong>
				</span>
			@endif
			
		</div>
	
		<button type="submit" class="btn btn-default btn-block btn-lg">Search</button>
	</form>
	
	<br>
	
	<div id="response"></div>
	
	
	
	

		
</body>
</html>


