<form method=post>
<input type = "text" name="ean">
</form>
<?php
// show items
if (isset($_SESSION['basket'])&&($_SESSION['basket']!="")) $basket = unserialize ($_SESSION['basket']);
//$e = count ($_SESSION['basket']);
array_add($basket,$_POST['ean']);

print_r($_SESSION['basket']);
print_r($_POST);

$_SESSION['basket']  = serialize ($basket);







function IsEanUser ($ean){
	//returns true if the ean is linked to a user 
	return false;
}

function ClearBasket ($ean){
	//if the ean 'clear' code is given, we kill the session variable  
	return false;
}


?>