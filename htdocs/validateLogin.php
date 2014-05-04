<?php
	session_start();
        include './utilityFunctions.php';
	$conn = oci_connect('SYSTEM', 'password', '//localhost/project');

	$query = 	"SELECT *
				FROM CUSTOMER 
				WHERE USERID = '".$_POST["username"]."' 
					AND PASSWORD = '".$_POST["password"]."'";

					
	 if (tryLoginAs('CUSTOMER', $_POST["username"], $_POST["password"])) {
            header('Location: index.php');
            exit;
         } else if (tryLoginAs('EMPLOYEE', $_POST["username"], $_POST["password"])) {
             
         } else {
             $_SESSION['user'] = 'error';
         }
	#header('Location: index.php');
	exit;
	
 