<?php
	
	$db['host'] 	= 'localhost';
	$db['dbname'] 	= 'maisnamblog';
	$db['dbuser']	= 'raju';
	$db['dbpass']	= 'rolemodel';
	mysql_connect($db['host'],$db['dbuser'],$db['dbpass']) or die(mysql_error());
	mysql_select_db($db['dbname']);
			
   	
?>
