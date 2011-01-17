<?
/*

 * Image-Creator / Sample
 * Part of PHP-Barcode 0.3pl1
 
 * (C) 2001,2002,2003,2004 by Folke Ashberg <folke@ashberg.de>
 
 * The newest version can be found at http://www.ashberg.de/bar
 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

 */

require("php-barcode.php");

function getvar($name){
    global $_GET, $_POST;
    if (isset($_GET[$name])) return $_GET[$name];
    else if (isset($_POST[$name])) return $_POST[$name];
    else return false;
}

if (get_magic_quotes_gpc()){
    $code=stripslashes(getvar('code'));
} else {
    $code=getvar('code');
}
if (!$code) $code='123456789012';

//barcode_print(getvar('code'),getvar('encoding'),getvar('scale'),getvar('mode'));


/*
 * call
 * http://........./barcode.php?code=012345678901
 *   or
 * http://........./barcode.php?code=012345678901&encoding=EAN&scale=4&mode=png
 *
 */

?>
<html>
<body>
<h1>Action Codes</h1>
<table valign="center" width="100%">
	<tr>
		<td width="25%">
			<?php barcode_print("000000012345","EAN","2","html"); ?>
		<td/>
		<td width="25%"><h2>RESET</h2>
		<td/>
		<td width="25%">
			<?php barcode_print("000000012346","EAN","2","html"); ?>
		<td/>
		<td width="25%"><h2>Make Deposit</h2>
		<td/>
	</tr>
</table>
<h1>Deposit Amounts</h1>
<table valign="center" width="100%">
<tr>
	<td width="25%">
		<?php barcode_print("000000000005","EAN","2","html"); ?>
	<td/>
	<td width="25%"><h2>5 Euro</h2>
	<td/>
	<td width="25%">
		<?php barcode_print("000000000025","EAN","2","html"); ?>
	<td/>
	<td width="25%"><h2>25 Euro</h2>
	<td/>
</tr>
<tr>
	<td>
		<?php barcode_print("000000000010","EAN","2","html"); ?>
	<td/>
	<td><h2>10 Euro</h2>
	<td/>
	<td>
		<?php barcode_print("000000000030","EAN","2","html"); ?>
	<td/>
	<td><h2>30 Euro</h2>
	<td/>
</tr>
<tr>
	<td>
		<?php barcode_print("000000000015","EAN","2","html"); ?>
	<td/>
	<td><h2>15 Euro</h2>
	<td/>
	<td>
		<?php barcode_print("000000000040","EAN","2","html"); ?>
	<td/>
	<td><h2>40 Euro</h2>
	<td/>
</tr>
<tr>
	<td>
		<?php barcode_print("000000000020","EAN","2","html"); ?>
	<td/>
	<td><h2>20 Euro</h2>
	<td/>
	<td>
		<?php barcode_print("000000000050","EAN","2","html"); ?>
	<td/>
	<td><h2>50 Euro</h2>
	<td/>
</tr>
</table>
</body>
</html>