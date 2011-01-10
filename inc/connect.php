<?php 
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

$db = mysql_select_db("shop", $con);



// just a handy validator 
function isvalidean13($input){
	preg_match('/\d{4}/', $input, $matches);
	$check = $matches[0];
	if ($check == $input) return true;
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






?>