<?php
session_start();

//  $tprice=0;
//  $tqnty=0;

$ptoducts = array(
	"101" => array("Price:$150.00" => "images/football.png"),
	"102" => array("Price:$120.00" => "images/tennis.png"),
	"103" => array("Price:$90.00" => "images/basketball.png"),
	"104" => array("Price:$110.00" => "images/table-tennis.png"),
	"105" => array("Price:$80.00" => "images/soccer.png"),
);
$prices = array(
	"101" => "150",
	"102" => "120",
	"103" => "90",
	"104" => "110",
	"105" => "80"
);

$action = $_GET['action'];
$id = $_GET['id'];
$price = $_GET['price'];
$pri = $_GET['pri'];
// echo $price;
// die();
$arr = array("id" => $id, "price" => $price, "val" => $action, "qnty" => 1);
// echo json_encode($arr);

if ($action == 'add') {


	if (!isset($_SESSION['cart'])) {
		// echo "in if";
		$_SESSION['cart'] = array();
		$_SESSION['tprice'] = 0;
		$_SESSION['tqnty'] = 0;
	}

	if (isset($_SESSION["cart"])) {
		// echo "inadd ";

		if (ischeck($id) == true) {

			array_push($_SESSION['cart'], $arr);
		}
		$_SESSION['tqnty'] += 1;
		$_SESSION['tprice'] += $prices[$id];
		echo json_encode($_SESSION);
	}
}
if ($action == 'delete') {
	foreach ($_SESSION['cart'] as $idx => $arr) {

		if ($arr['id'] == $id) {

			$qt = $arr['qnty'];
			$_SESSION['tqnty'] -= $qt;
			$_SESSION['tprice'] -= $prices[$id] * $qt;
			break;
		}
	}

	delete($_GET['id']);
	echo json_encode($_SESSION);
}

function ischeck($id)
{

	foreach ($_SESSION['cart'] as $idx => $arr) {


		if ($arr['id'] == $id) {
			// echo "false";
			// $_SESSION[$id][$k]['qnty']=$v['qnty']+1;
			$_SESSION['cart'][$idx]['qnty']++;


			return false;
		}
		// }
	}
	// // echo "true";

	return true;
}

// session_unset();
// session_destroy();

function disply()
{

	$html = "<table><tr><th>product id</th><th>product price</th></tr>";
	foreach ($_SESSION as $key => $val) {
		if ($key == 'tprice' || $key == 'tqnty') {
			continue;
		}

		foreach ($val as $key1 => $val1) {

			$html .= "<tr><form action='' method=GET><td>"
				. $val1['id'] .
				"</td><td>"
				. $val1['price'] .
				"</td><td>"
				. "<a href=products.php?id=" . $val1['id'] . "price=" . $val1['price'] . "&val=delete" . ">delete</a>" .
				"</td></form></tr>";
		}

		$html .= "</table>";
	}

	echo $html;
}

function delete($id)
{
	foreach ($_SESSION['cart'] as $idx => $arr) {

		if ($arr['id'] == $id) {

			array_splice($_SESSION['cart'], $idx, 1);
			// return false;
			break;
		}
		// }
	}
}
