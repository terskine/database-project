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
    
    return $statement;
}

function changeProductStock($pid, $quantity, $action)
{
    $new_stock = 0;
    $connection = $GLOBALS['db'];
    $sql_text = "SELECT stock FROM products WHERE productid = ". $pid;
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    $row = oci_fetch_array($statement, OCI_BOTH);
    
    
    if ($action == 'add')
    {
        $new_stock = $row[0] + $quantity;
        $sql_update = "UPDATE products SET stock = ".$new_stock." WHERE product_id = ".$pid;
        $statement = oci_parse($connection, $sql_text);
        oci_execute($statement);
    }
    elseif ($action == 'sub')
    {
        $new_stock = $row[0] - $quantity;
        
        if ($new_stock < 0)
        {
            $sql_update = "UPDATE products SET stock = 0 WHERE product_id = ".$pid;
            $statement = oci_parse($connection, $sql_text);
            oci_execute($statement);
        }
        else
        {
            $sql_update = "UPDATE products SET stock = ".$new_stock." WHERE product_id = ".$pid;
            $statement = oci_parse($connection, $sql_text);
            oci_execute($statement);
        }
        
    }
    else
    {
        
    }
}


?>