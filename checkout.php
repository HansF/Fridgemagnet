<?php
session_start();
if ($_POST['formnr']==4) header("Location: ./select.php");
/*
1) scan ean user 1 
2) scan amount 
3) confirm with ean user 2
*/
require ('./inc/settings.php');
require ('./inc/connect.php');
if ($_POST['ean']==1000){
									session_destroy();
									header("Location: ./select.php");
									}
require ('./inc/header.php');

$balance = GetAccountBalanceById($_SESSION['userid']);
if (isset($_SESSION['basket'])){
	$total = $_SESSION['total'];
	$id = $_SESSION['userid'];
//	echo "total $total - balance $balance";
	if ($total <= $balance){
		$sql = "INSERT INTO `shop`.`transactions` (`id`, `amount`, `user`, `date`) VALUES (NULL, '-$total', '$id', CURRENT_TIMESTAMP);";
		//echo $sql;
		$result = mysql_query($sql);
		echo $total." Euros snatched from your account<BR/>";
		}else{
		echo "<h1>Aborted: E_OutOfMoney</h1><p>Your total was $total $cashsign, BUT you have only $balance $cashsign left</p>"; 
		}
	}else{
	
	echo "You have $balance $cashsign left";
	
	
	}
session_destroy();
	


?>
<form method=post action='select.php'>
	<input type = "hidden" name="formnr" value="<?php echo $formnr ?>" />
	<input type = "text" name="ean"  class="auto-focus" />
</form>

<?php
require ('./inc/footer.php');


function insertDepositToDb ($donor,$amount,$validator){
	global $db;
	$donorid 		= EanToUser($donor);
	$validatorid 	= EanToUser($validator);
	$sql = "INSERT INTO `shop`.`transactions` (`id`, `amount`, `user`, `date`) VALUES (NULL, '".$amount."', '".$donorid."', CURRENT_TIMESTAMP)";
	//echo $sql;
	$result = mysql_query($sql);
	$lastId = mysql_insert_id();
	$sql = "INSERT INTO `shop`.`deposit` (`id`, `deposit_by`, `checked_by`, `transaction_id`) VALUES (NULL, '".$donorid."', '".$validatorid."', '".$lastId."');";
	$result = mysql_query($sql);
	

}


?>