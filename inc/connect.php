<?php 
include ('./settings.php');
$con = mysql_connect($dbhost,$dbuname,$dbpasswd);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$db = mysql_select_db($dbname, $con);



// just a handy validator 
	
function validate_UPCABarcode($barcode){
  // check to see if barcode is 12 digits long
  if(!preg_match("/^[0-9]{12}$/",$barcode)) {
    return false;
  }
  $digits = $barcode;
  // 1. sum each of the odd numbered digits
  $odd_sum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8] + $digits[10];  
  // 2. multiply result by three
  $odd_sum_three = $odd_sum * 3;
  // 3. add the result to the sum of each of the even numbered digits
  $even_sum = $digits[1] + $digits[3] + $digits[5] + $digits[7] + $digits[9];
  $total_sum = $odd_sum_three + $even_sum;
  // 4. subtract the result from the next highest power of 10
  $next_ten = (ceil($total_sum/10))*10;
  $check_digit = $next_ten - $total_sum;
  // if the check digit and the last digit of the barcode are OK return true;
  if($check_digit == $digits[11]) {
		return true;
	}
return false;
}

// function from http://www.dorianmoore.com/works/201/php-validate-upc-and-ean13-barcodes
function isvalidean13($barcode){
	// check to see if barcode is 13 digits long
	if(!preg_match("/^[0-9]{13}$/",$barcode)) {
	return false;
	}
	$digits = $barcode;
	// 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
	$even_sum = $digits[1] + $digits[3] + $digits[5] + $digits[7] + $digits[9] + $digits[11];
	// 2. Multiply this result by 3.
	$even_sum_three = $even_sum * 3;
	// 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
	$odd_sum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8] + $digits[10];
	// 4. Sum the results of steps 2 and 3.
	$total_sum = $even_sum_three + $odd_sum;
	// 5. The check character is the smallest number which, when added to the result in step 4, produces a multiple of 10.
	$next_ten = (ceil($total_sum/10))*10;
	$check_digit = $next_ten - $total_sum;
	// if the check digit and the last digit of the barcode are OK return true;
	if($check_digit == $digits[12]) {
		return true;
		}
return false;
} 
	
	
function EanToCash($input){
	$amount = substr($input, 2, 2);
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