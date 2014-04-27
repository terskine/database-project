<?php
	session_start();
	$conn = oci_connect('SYSTEM', 'password', '//localhost/project');

	$query = 	"SELECT *
				FROM CUSTOMER 
				WHERE USERID = '".$_POST["username"]."' 
					AND PASSWORD = '".$_POST["password"]."'";

					
	 if (tryLoginAs('CUSTOMER', $query, $conn)) {
            header('Location: index.php');
            exit;
         } else if (tryLoginAs('EMPLOYEE', $query, $conn)) {
             
         } else {
             $_SESSION['user'] = 'error';
         }
	header('Location: index.php');
	exit;
	
	function tryLoginAs($userStr) {
                $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
                $query = "SELECT *
				FROM ".$userStr. 
				" WHERE USERID = '".$_POST["username"]."' 
					AND PASSWORD = '".$_POST["password"]."'";
		$stid=oci_parse($conn, $query);
		oci_execute($stid);

		if($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
			$_SESSION['user'] = $userStr;
			addFieldsToSession($stid, $row);	
			oci_close($conn);	
			return true;
                        
		}
                return false;
		
	}


	function addFieldsToSession(&$stid, $row) {

			for ($i = 1; $i <= oci_num_fields($stid); $i++) {		
				$_SESSION[oci_field_name($stid, $i)] = $row[oci_field_name($stid, $i)];
			}	
		}
 