<?php
  $path_prefix=base_url('asset/user/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <style media="print">
  .noPrint{ display: none; }
  .yesPrint{ display: block !important; }
</style> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="<?=$path_prefix?>js/custom.js"></script> 
</head>
<body>
	<div id="printable">
		<div class="container">

			<div class="page-header">
				<h1>Campus Exchange System</h1>
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
						<td><?=$seller_data[0]->name?> (contact : 7569784555, 201812028@daiict.ac.in)</td>
					</tr>
					<tr>
						<td>Buyer</td>
						<td><?=$buyer_data[0]->name?></td>
					</tr>
					<tr>
						<td>Product</td>
						<td><?=$name?></td>
					</tr>
					<tr>
						<td>Price</td>
						<td><?=$final_price?></td>
					</tr>
					<tr>
						<td>Date</td>
						<td><?=$date_sold?></td>
					</tr>
				</tbody>
			</table>
			<small>This is online automatically generated receipt.</small>
		</div>
	</div>
</body>
</html>
<script>
	window.print();
</script>