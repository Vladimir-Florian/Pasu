<!doctype html>

 <html lang="en">
    
 <head>
 
	<meta charset="UTF-8">
	<title> Document </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>   
   
 </head>

 <body>
 
	@include('partials.nav')
 
     <div class="container">
        @yield('content')		
     </div>
	 
	@include('partials.footer')	 

 </body>
</html>

