<?php
	session_start();
	$conn = oci_connect('SYSTEM', 'password', '//localhost/project');

	$query = 	"SELECT *
				FROM CUSTOMER 
				WHERE USERID = '".$_POST["username"]."' 
					AND PASSWORD = '".$_POST["password"]."'";

					
	tryLoginAs('CUSTOMER', $query, $conn);	
	
	$query = 	"SELECT *
				FROM EMPLOYEE 
				WHERE USERID = '".$_POST["username"]."' 
					AND PASSWORD = '".$_POST["password"]."'";
					
	tryLoginAs('EMPLOYEE', $query, $conn);	

	$_SESSION['user'] = 'error';
	oci_close($conn);	
	header('Location: index.php');
	exit;
	
	function tryLoginAs($userStr, $query, $conn) {
		$stid=oci_parse($conn, $query);
		oci_execute($stid);

		if($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			$_SESSION['user'] = $userStr;
			addFieldsToSession($stid, $row);	
			oci_close($conn);	
			header('Location: index.php');
			exit;
		}
		
	}


	function addFieldsToSession(&$stid, $row) {

			for ($i = 1; $i <= oci_num_fields($stid); $i++) {		
				$_SESSION[oci_field_name($stid, $i)] = $row[oci_field_name($stid, $i)];
			}	
		}
 ?> 