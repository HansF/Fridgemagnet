<?php
/*

	geld in kas : 
	SELECT sum(`amount`) FROM `transactions` WHERE `amount` > 0 AND `date` > '2010-01-02 17:34:56'

	Laatste ophaling: 
	SELECT time FROM `withdraw` WHERE 1 order by id desc LIMIT  0,1

	update:
	$sql = "INSERT INTO `shop`.`withdraw` (`id`, `time`) VALUES (NULL, CURRENT_TIMESTAMP);";

	*/



if ($_POST['formnr']==4) header("Location: ./select.php");
/*
1) scan ean user 1 
2) scan amount 
3) confirm with ean user 2
*/
require ('./inc/settings.php');
require ('./inc/connect.php');

if (isset($_POST['ean'])) $input = inputswitch($_POST['ean']);
if ($input['command']=="delete"){
	session_destroy();
	header("Location: ./select.php");
}

if ($_POST['formnr']==3){
	session_destroy();
	header("Location: ./select.php");
								}
								
require ('./inc/header.php');


if (!isset($_POST['formnr'])){
								echo "<h2>Money in the bank</h2>";
								
//print_r($_POST); 
								$formnr = 1;
								$sql = "SELECT time FROM `withdraw` ORDER by time DESC LIMIT 0,1";								
								$result = mysql_query($sql);
								$lastempty = mysql_result($result, 0);
								$sql ="SELECT sum(`amount`) FROM `transactions` WHERE `amount` > 0 AND `date` > '".$lastempty."'";						
								$result = mysql_query($sql);
								$cash = mysql_result($result, 0);
								echo "<p>Money in the bank : ". $cash ."</p>";
								echo "<p>To Empty the cash, swipe the empty-code again.</p>";
								echo "<p>To go home, scan the reset code.</p>";
								
								
								}
if ($_POST['formnr']==1){
								if ($input['command']!="empty") die("Wtf!?");
								echo "<h2>The amount has been reset.</h2>";
								$sql = "INSERT INTO `shop`.`withdraw` (`id`, `time`) VALUES (NULL, CURRENT_TIMESTAMP);";					
								$result = mysql_query($sql);
								$formnr = 2;
								}
if ($_POST['formnr']==2){
								echo "<h2>Amount in cashbox reset</h2>";
								echo "<p> you can hit the reset code now</p>";
								$formnr = 3;
								}
?>
<form method=post action='empty.php'>
	<input type = "text" name="ean"  class="auto-focus" />
	<input type = "hidden" name="formnr" value="<?php echo $formnr ?>" />
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