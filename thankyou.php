<?php 
$chosenvaluesdata = $_POST['chosenvaluesdata']; 
$con = mysql_connect('localhost', 'root', '');
	if (!$con)
	  {
	  die('Could not connect: ' .mysql_error());
	  }
	mysql_select_db('testdb', $con); 
	
	$query = "INSERT INTO chosenvalues (chosenvaluesdata) VALUES('$chosenvaluesdata')";

	$result = mysql_query($query,$con);
	if($result){
		echo '<h1>Thank you! Your data has been saved successfully!</h1>';
	}
?>