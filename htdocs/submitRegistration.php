<?php
	
	//$conn = oci_connect('SYSTEM', 'password', '//localhost/project');

	$query = 	"INSERT INTO CUSTOMER VALUES(	CUSTOMER_PK.NEXTVAL,'"
												.$_POST["userID"]."', 
												'".$_POST["password"]."',
												'".$_POST["name"]."',
												'".$_POST["address"]."',
												'".$_POST["homePhone"]."',
												'".$_POST["mobilePhone"]."',
												'".$_POST["email"]."',
												'S',
												".$_POST["country"]."
											)";
	echo $query;		

?>