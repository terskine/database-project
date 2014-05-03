<?php
require_once 'config.php';

function getProductInfo($pid)
{
    $connection = $GLOBALS['db'];
    $sql_text = "SELECT * FROM products WHERE productid = ". $pid;
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    $row = oci_fetch_array($statement, OCI_BOTH);

    return $row;
}


function getAllProducts()
{
    $connection = $GLOBALS['db'];
    $sql_text = "SELECT * FROM products";
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    #$row = oci_fetch_array($statement, OCI_BOTH);
    
    return $statement;
}

?>