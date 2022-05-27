<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contents</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script src="js/my.js"></script>
  <link rel="stylesheet" href="css/my.css">
</head>
<body>

<?php
include $menu;
?> 

<div class=container>

	<div class=row>
			<?php
				include $page;
			?>
	</div>
</div>

<br><br>

<div class="container-fluid footer text-center">
	<div class="row tt3"  style='text-align:center;'>
	 
		 <div class=col-md-3></div>
		 <div class=col-md-6 id=tr>
		 <h2>Copyright &copy; Webia Team</h2>
		 </div>
		 <div class=col-md-3></div>
	</div>
</div>
 
</body>

</html>