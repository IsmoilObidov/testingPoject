<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	{{-- Livewire --}}
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
	<link rel="stylesheet" href="{{'css/app.css'}}">
	<script src="{{'js/app.js'}}"></script>
	@livewireScripts
</head>
<body>
	
	
	<br>
	@livewire('domain')
	
	
	
	
	<script>

		window.addEventListener("update", (event) => {
	
			event.detail.product_list.forEach(function(item, i, arr) {
	
				df = `<tr>
					<td>${ item[0] }</td>
					</tr>
					`
	
				$('#product_list').append(df)
			});		
			
		});
	
		</script>

		@livewireStyles
		
</body>
</html>


