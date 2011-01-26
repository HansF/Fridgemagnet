<?php
session_start();
require ('./inc/connect.php');

// hackerspace-soft, so let's sanitize the imput a bit :-)
if (isset($_POST['ean'])) $input = inputswitch($_POST['ean']);
$_SESSION['input']=$input;
//print_r($input);

// let's start with checking if they gave a command and send them ontheir way
if ($input['type']=="command"){
	if ($input['command']=="delete") killcart();
	
	if ($input['command']=="deposit"){
			header("Location: ./deposit.php");
	}
	if ($input['command']=="empty"){
			header("Location: ./empty.php");
	}
	if ($input['command']=="error") header("Location: ./error.php");
}

// maybe it's a user ? 
if ($input['type']=="user") GoToCheckOutOrAccount($input['id']);

// meh, someone scanned a product let's do the page 
require ('./inc/header.php');

// No reset? Ok is it an item then? 
if ($input['type']=="product"){
			addToCart($input['ean']);
			echo printcart();
}


function GoToCheckOutOrAccount($userid){
//	session_start();
	$_SESSION['userid']=$userid;
	header("Location: ./checkout.php");
}

?>
<form method=post action='select.php'>
<input type = "text" name="ean"  class="auto-focus" >
</form>
<?php
function addToCart($ean){
	// show items
	if (isset($_SESSION['basket'])&&($_SESSION['basket']!="")) $basket = unserialize ($_SESSION['basket']);
	//$e = count ($_SESSION['basket']);
	//array_push($basket,$_POST['ean']);
	$basket[]= $ean;
	$_SESSION['basket']  = serialize ($basket);
}

function printcart(){
	$basket = unserialize ($_SESSION['basket']);
	$total = 0; 
	$output = "<div class='container_12'><div class='grid_5'><ul>";
	while($item = array_shift($basket)){
		$sql = "SELECT * FROM `products` WHERE ean='".$item."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$total = $total + $row['price'];
		$_SESSION['total']=$total;
		$output .="<li>".$row['name']." - ".$row['price']." Euro</li>"; 
	}
	$output .= "</ul></div>";
	$output .= "<div class='grid_5'><p>Total: ".$total."</p></div></div>	";
	$output .= "<p>Swipe member card to pay.</p>";
	return $output; 

}

function ShowMeTheMoney($amount){
	







}

require ('./inc/footer.php');
?>