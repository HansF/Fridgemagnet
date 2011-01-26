<?php 

print_r ( ShowMeTheMoney(123.85));

function ShowMeTheMoney($amount){
	
	// if($amount%50>0) ;
	if($amount>50){
		$bills['50']= ($amount-($amount%50))/50;
		$amount = $amount - ($bills[50]*50);
	}
	if($amount>20){
		$bills['20']= ($amount-($amount%20))/20;
		$amount = $amount - ($bills[20]*20);
	}
	if($amount>10){
		$bills['10']= ($amount-($amount%10))/10;
		$amount = $amount - ($bills[10]*10);
	}
	if($amount>5){
		$bills['5']= ($amount-($amount%5))/5;
		$amount = $amount - ($bills[5]*5);
	}
	if($amount>2){
		$bills['2']= ($amount-($amount%2))/2;
		$amount = $amount - ($bills[2]*2);
	}
	if($amount>1){
		$bills['1']= ($amount-($amount%1))/1;
		$amount = $amount - ($bills[1]);
	}
	if($amount>0.50){
		$bills['0.50']= ($amount-($amount%0.50))/0.50;
		$amount = $amount - ($bills['0.50']);
	}
	
	if($amount>0.20){
		$bills['0.20']= ($amount-($amount%0.20))/0.20;
		$amount = $amount - ($bills['0.20']);
	}
		
	if($amount>0.1){
		$bills['0.1']= ($amount-($amount%0.1))/0.1;
		$amount = $amount - ($bills['0.10']);
	}
	if($amount>0.05){
		$bills['0.05']= ($amount-($amount%0.050))/50;
		$amount = $amount - ($bills['0.05']);
	}
	




return $bills;

}

?>