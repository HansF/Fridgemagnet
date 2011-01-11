<?php
session_start();
if ($_POST['formnr']==4) header("Location: ./select.php");
if (($_SESSION['donor']==$_POST['ean'])&&($_POST['formnr']==3)){
									session_destroy();
									header("Location: ./select.php");
									}
/*
1) scan ean user 1 
2) scan amount 
3) confirm with ean user 2
*/
require ('./inc/settings.php');
require ('./inc/connect.php');
require ('./inc/header.php');

$action = "deposit.php";
if (isset($_POST['ean'])&&!isvalidean13($_POST['ean'])) die('naughty :-)');
if ($_POST['ean']==$deletecode){
									session_destroy();
									header("Location: ./select.php");
									}

if (!isset($_POST['formnr'])){
								echo "<h2>Swipe card of depositor</h2>";
								$formnr = 1;
								$_SESSION['donor']=$_POST['ean'];
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
if (($_POST['formnr']==3)&&($_SESSION['donor']!=$_POST['ean'])){

								echo "<h2>confirmscreen</h2>";
								$_SESSION['validator']=$_POST['ean'];
								insertDepositToDb($_SESSION['donor'],$_SESSION['amount'],$_SESSION['validator']);
								//print_r($_SESSION);
								echo "<p>Account increased with ".$_SESSION['amount'].".<br/>Hit the reset code to go to the home screen.</p>";
								session_destroy();
								$formnr = 4;
								$action = "select.php";
								}
?>
<form method=post action='<?php echo $action ?>'>
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