<?php

session_start();
include 'config.php';

?>

<!DOCTYPE html>
<html>

<head>
	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
	<!-- <div id="header">
		<h1 id="logo">Logo</h1>
		<nav>
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div> -->
	<?php
	include 'hadr.php';
	?>
	<div id="main">

		<div id="products">


			<?php
			foreach ($ptoducts as $id => $arr) {

				foreach ($arr as $price => $name) {

					echo "<form action='' method=GET><div id=product-" . $id . " class=product>
				<img src=" . $name . ">
				<h3  class=title><a href=#>Product" . $id . "</a></h3>
				<span>" . $price . "</span>

			
				
				<a class=add-to-cart  href=#  data-pri=" . $prices[$id] . " data-pid=" . $id . " data-price=" . $price . " action=add" . ">Add To Cart</a>
				
			</div></form>";
				}
			}

			?>

		</div>

		<div id="table">
			<?php
			// disply();
			// echo "<h3> your  total price = " . $_SESSION['tprice'] . "</h3>";
			// echo "<h3> total quantity = " . $_SESSION['tqnty'] . "</h3>";
			?>



		</div>
	</div>
	<div id="totalq">

	</div>
	<div id="totalp">

	</div>

	<?php
	include 'footr.php';

	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="index.js"></script>
</body>

</html>