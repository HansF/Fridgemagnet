<?php
require ('./inc/settings.php');
require ('./inc/connect.php');

// hackerspace-soft, so let's sanitize the imput a bit :-)
if (isset($_POST['ean'])) $input = inputswitch($_POST['ean']);
$_SESSION['input']=$input;
//print_r($input);

// let's start with checking if they gave a command and send them ontheir way
if ( ($input['type']=="command")){
	if ($input['command']=="delete") killcart();
	
	if ($input['command']=="deposit"){
			header("Location: ./deposit.php");
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
	$_SESSION['userid']=$userid;
	header("Location: ./checkout.php");
}

/*
function inputswitch: 
in : barcode 
check input regexp and is existing number. 
*/
function inputswitch($input){
	// check input against regexp
	preg_match('/\d{4}/', $input, $matches);
	$input = $matches[0];
	// check if its a product 
		$sql = "SELECT * FROM `products` WHERE ean='".$input."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$output['ean']=$input; 
					$output['type']="product";
					return $output;
					}
					
	// check it its a user
		$sql = "SELECT * FROM `users` WHERE ean='".$input."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					$output['id']=$row['id']; 
					$output['type']="user";
					return $output;
					}

	// check if its a command
		$sql = "SELECT action FROM `actioncodes` WHERE ean='".$input."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					$output['command']=$row['action']; 
					$output['type']="command";
					return $output;
					}

	// none of the above, how scary!
					$output['command']="error"; 
					$output['type']="command";
					killcart(); //no sessions for you, nasty kiddo!
					return $output;
}


// kill the session on delete code 
function killcart(){
	session_destroy();
	unset ($_POST['ean']);
	//echo "Car should be empty!"; 
	return true;
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
	$output = "<ul>";
	while($item = array_shift($basket)){
		$sql = "SELECT * FROM `products` WHERE ean='".$item."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$total = $total + $row['price'];
		$_SESSION['total']=$total;
		$output .="<li>".$row['name']." - ".$row['price']." Euro</li>"; 
	}
	$output .= "</ul>";
	$output .= "<p>Total: ".$total."</p>";
	$output .= "<p>Swipe member card to pay.</p>";
	return $output; 

}


require ('./inc/footer.php');
?>