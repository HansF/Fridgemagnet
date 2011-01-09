<?php
/*

	geld in kas : 
	SELECT sum(`amount`) FROM `transactions` WHERE `amount` > 0 AND `date` > '2010-01-02 17:34:56'

	Laatste ophaling: 
	SELECT time FROM `withdraw` WHERE 1 order by id desc LIMIT  0,1

	update:
	$sql = "INSERT INTO `shop`.`withdraw` (`id`, `time`) VALUES (NULL, CURRENT_TIMESTAMP);";

	*/



?> 