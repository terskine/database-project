<?php
require_once 'config.php';

function getCountries($selected=NULL) {
    echo '<select name="country" required>';
 
    $conn = $GLOBALS['db'];
    $stid=oci_parse($conn, "SELECT * FROM COUNTRY");
    oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        if ($row['COUNTRYID'] == $selected) {
            echo "<option value=".$row['COUNTRYID']." selected>".$row['COUNTRYNAME']."</option>";
        } else {
            echo "<option value=".$row['COUNTRYID'].">".$row['COUNTRYNAME']."</option>";
        }
    }
    oci_close($conn);
    echo '</select>';

}

function tryLoginAs($userStr, $username, $password) {
                $conn = $GLOBALS['db'];
                $query = "SELECT *
				FROM ".$userStr. 
				" WHERE USERID = '".$username."' 
					AND PASSWORD = '".$password."'";
                echo "This is query: ".$query."</br>";
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

