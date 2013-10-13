<?php

	include_once('database.php');

	if (isset($_POST['postTitle']) ) {
   	 	$title 	 = 	$_POST['postTitle'];
   		$summary =	$_POST['postDes'];
   		$content =	$_POST['postCont'];
   	 	insertPost($title,$summary,$content);
	}

	else if( isset($_POST['rowNo']) && (isset($_POST['edit']) !== 1) ) {
		$rowNo = $_POST['rowNo'];
		$deleteQuery = "DELETE FROM blogposts WHERE blogid = $rowNo";
		mysql_query($deleteQuery) or die($rowNo.mysql_error());
		echo "Article Deleted";
	}

	else if( isset($_POST['rowNo']) && (isset($_POST['edit']) == 1 ) ) {
		$rowNo = $_POST['rowNo'];
		$deleteQuery = "select * FROM blogposts WHERE blogid = $rowNo";
		mysql_query($deleteQuery) or die($rowNo.mysql_error());
		
	}
	else {

		return false;
	}

	function insertPost($title,$summary,$content) {	
		$query = "INSERT INTO `blogposts` SET
				`title` 	= '{$title}',
				`summary`  	= '{$summary}',				
				`content` 	= '{$content}' ";
										
		mysql_query($query) or die(mysql_error());
		echo "The article"." <strong>".$title."</strong> ". "has been posted" ;		
	}	

?>
	