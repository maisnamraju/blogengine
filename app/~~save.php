<?php 
	include_once('../engine/database.php');
if (isset($_POST['blogsubmit'])  ){
   	 	$title 	 = 	$_POST['postTitle'];
   		$summary =	$_POST['postDes'];
   		$content =	$_POST['postCont'];
   		$_date   =  date('Y-m-d');
   	 	insertBlogPost($title,$summary,$content,$_date);
}

function insertBlogPost($title,$summary,$content,$_date) {	
		$query = "INSERT INTO `blogposts` SET
				`title` 	= '{$title}',
				`desc`  	= '{$summary}',
				`content` 	= '{$content}' ";

				//still need to enter date into the database				
		mysql_query($query) or die(mysql_error());
		//print_r($query);				
}
?>

		