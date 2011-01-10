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
require ('./inc/header.php');

if (isset($_POST['ean'])) $input = inputswitch($_POST['ean']);

if (isset($_POST['ean'])&&($_POST['ean'])!=) die('naughty :-)');
if ($_POST['ean']==$deletecode){
									session_destroy();
									header("Location: ./select.php");
									}

if (!isset($_POST['formnr'])){
								echo "<h2>Money in the bank</h2>";
								$formnr = 1;
								$sql = "SELECT time FROM `withdraw` ORDER by time DESC LIMIT 0,1";								
								$result = mysql_query($sql);
								$lastempty = mysql_result($result, 0);
								$sql ="SELECT sum(`amount`) FROM `transactions` WHERE `amount` > 0 AND `date` > '".$lastempty."'";						
								$result = mysql_query($sql);
								$cash = mysql_result($result, 0);
								echo "<p>Money in the bank : ". $cash ."</p>";
								
								
								}
if ($_POST['formnr']==1){
								echo "<h2>Scan the code of the right amount</h2>";
								$_SESSION['donor']=$_POST['ean'];
								$_SESSION['amount']=EanToCash($_POST['ean']);
								$formnr = 2;
								}
if ($_POST['formnr']==2){
								echo "<h2>Swipe card of validator</h2>";
								$_SESSION['amount']=EanToCash($_POST['ean']);
								$formnr = 3;
								}
if ($_POST['formnr']==3){
								echo "<h2>confirmscreen</h2>";
								$_SESSION['validator']=$_POST['ean'];
								insertDepositToDb($_SESSION['donor'],$_SESSION['amount'],$_SESSION['validator']);
								//print_r($_SESSION);
								echo "<p>Account increased with ".$_SESSION['amount'].".<br/>Hit the reset code to go to the home screen.</p>";
								session_destroy();
								$formnr = 4;
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