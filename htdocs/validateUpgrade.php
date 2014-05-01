<?php session_start();

$query =    "UPDATE CUSTOMER 
            SET TYPE = '".$_POST["customerType"]."' 
            WHERE CUSTOMERID IN 
                (SELECT CUSTOMERID FROM 
                    (SELECT CUSTOMERID, SUM(ITEM.QUANTITY) AS TOTAL 
                    FROM ITEM NATURAL JOIN ORDERTABLE 
                    WHERE ORDERTABLE.ORDERDATE < TO_DATE('".$_POST["endingDate"]."', 'yyyy-mm-dd') 
                        AND ORDERTABLE.ORDERDATE > TO_DATE('".$_POST["startingDate"]."', 'yyyy-mm-dd') 
                    GROUP BY CUSTOMERID) 
                WHERE TOTAL > ".$_POST["amount"].")";

echo $query;
$conn = oci_connect('SYSTEM', 'password', '//localhost/project');
$stid=oci_parse($conn, $query);
oci_execute($stid);
oci_close($conn);
header('Location: upgradeSuccess.php');
exit;



