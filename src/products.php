<?php
include "config.php";
session_start();
if (isset($_POST["submit"])) {
	$id = array_keys($_POST["submit"])[0];
	if (in_array($id, $_SESSION["user"]["products"])) {
		$_SESSION["user"]["productsQuantity"][$id]++;
	} else {
		array_push($_SESSION["user"]["products"], $id);
		$_SESSION["user"]["productsQuantity"][$id]++;
	}
}
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
	<?php include "header.php"; ?>
	<div id="main">
		<div id="products">
			<form action="#" method="post">
				<?php
				foreach ($products as $product) {
				?>
					<div id="product-<?php echo $product["id"]; ?>" class="product">
						<img src="<?php echo "images/" . $product["image"]; ?>">
						<h3 class="title"><a href="#">Product <?php echo $product["id"]; ?></a></h3>
						<span>Price: <?php echo $product["price"]; ?>$</span>
						<input type="submit" name="submit[<?php echo $product["id"]; ?>]" class="add-to-cart" value="Add To Cart">
					</div>
				<?php
				}
				?>
			</form>
		</div>
		<div class="cart">
			<?php
			$total = 0;
			if (count($_SESSION["user"]["products"]) > 0) {
				echo "
				<table>
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Remove</th>
					</tr>
				</thead>
				";
				foreach ($_SESSION["user"]["productsQuantity"] as $k => $v) {
					if (!$k == 0) {
						echo "
						<tbody>
						<form action='update.php' method='post'>
						<tr>
						";
						$object = getProductById($k);
						$total =  $object["price"] * $v;
						echo "
						<td>" . $object["id"] . "</td>
						<td>" . $object["name"] . "</td>
						<td>" . $object["price"] . "$</td>
						<td>
						<input type='number' name='quantity[" . $object["id"] . "]' value='" . $v . "'/>
						<input type='submit' class='btn' value='submit' name='submit[" . $object["id"] . "]'/>
						</td>
						<td>" . $total . "$</td>
						<td><a href='delete.php?id=" . $k . "'>X</a></td>
						</tr>
						";
						$total += $k * $v;
					}
				}
				echo "
				</form>
				</tbody>
				</table>
				";
			}

			?>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>