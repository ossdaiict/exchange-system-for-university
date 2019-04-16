<?php
  $path_prefix=base_url('asset/user/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<div id="printable">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


		<!-- Font awesome -->
		<link href="<?=$path_prefix?>css/font-awesome.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link href="<?=$path_prefix?>css/bootstrap.css" rel="stylesheet">   
		<!-- Main style sheet -->
		<link href="<?=$path_prefix?>css/style.css" rel="stylesheet">    	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<div class="container">

			<div class="page-header">
				<h1>Campus Exchange System</h1>
			</div>
			<div class="aa-logo">
				<a href="<?=site_url('product/');?>">
					<span class="fa fa-shopping-cart"></span>
					<p>CES<strong></strong> <span>Campus Exchange System</span></p>
				</a>
			</div>

			<p>Receipt of purchase</p>
			<table class="table table-striped">
				<!-- <thead>
					<tr>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Email</th>
					</tr>
				</thead> -->
				<tbody>
					<tr>
						<td>Seller</td>
						<td>Siddharth, 7569784555, 201812028@daiict.ac.in</td>
					</tr>
					<tr>
						<td>Buyer</td>
						<td>bhomi</td>
					</tr>
					<tr>
						<td>Product</td>
						<td>Mobile</td>
					</tr>
					<tr>
						<td>Price</td>
						<td>INR 5000</td>
					</tr>
					<tr>
						<td>Date</td>
						<td>05 apr 2019</td>
					</tr>
				</tbody>
			</table>
			<small>This is online automatically generated receipt.</small>
		</div>
	</div>
	<button onclick="$('#printable').printElement();">Print</button>
</body>
</html>
