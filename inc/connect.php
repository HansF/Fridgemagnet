<?php 
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db = mysql_select_db("shop", $con);

// just a handy validator 
function isvalidean13($input){
	preg_match('/\d{13}/', $input, $matches);
	$check = $matches[0];
	if ($check == $input) return true;
	}
	
function EanToCash($input){
	$amount = substr($input, 0, strlen($input)-1);
	return $input; 
}

function EanToUser($input){
		$sql = "SELECT * FROM `users` WHERE ean='".$input."' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					return $row['id']; 
					}else{
					return false; 
					}
}

function GetAccountBalanceById($input){
		$sql = "SELECT sum(`amount`) as total FROM `transactions` LEFT JOIN users ON (users.id = transactions.user) WHERE `users`.id = $input group by `user`";
		//echo $sql;
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					return $row['total']; 
					}else{
					return false; 
					}
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
		$sql = "SELECT * FROM `products` WHERE ean='$input' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$output['ean']=$input; 
					$output['type']="product";
					return $output;
					}
					
	// check it its a user
		$sql = "SELECT * FROM `users` WHERE ean='$input' LIMIT 0, 1 ";
		$result = mysql_query($sql);
		if (mysql_num_rows ($result) == 1){
					$row = mysql_fetch_assoc($result);
					$output['id']=$row['id']; 
					$output['type']="user";
					return $output;
					}

	// check if its a command
		$sql = "SELECT action FROM `actioncodes` WHERE ean='$input' LIMIT 0, 1 ";
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