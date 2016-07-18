<?php 
$parentid = $_REQUEST['id']; 
$con = mysql_connect('localhost', 'root', '');
	if (!$con)
	  {
	  die('Could not connect: ' .mysql_error());
	  }
	mysql_select_db('testdb', $con); 
	
	$query = "SELECT * from child where parentid = '".$parentid."'";

	$result = mysql_query($query,$con);
	if (mysql_num_rows($result) > 0) { 
	while($row = mysql_fetch_array($result,MYSQLI_ASSOC)) {
		echo '<div><input type="checkbox" name="parentid_'.$parentid.'" class="childvalues" value="'.$row['childname'].'"> '.$row['childname'].'</div>';
	}}
?>