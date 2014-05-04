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
        $sql_update = "UPDATE products SET stock = ".$new_stock." WHERE productid = ".$pid;
        $statement = oci_parse($connection, $sql_update);
        oci_execute($statement);
        
        return $new_stock;
    }
    elseif ($action == 'sub')
    {
        if ($row[0] == 0)
        {
            return 0;
        }
        
        $new_stock = $row[0] - $quantity;
        
        if ($new_stock < 0)
        {
            $sql_update = "UPDATE products SET stock = 0 WHERE productid = ".$pid;
            
            $statement = oci_parse($connection, $sql_update);
            oci_execute($statement);
            
            return $row[0];
        }
        else
        {
            $sql_update = "UPDATE products SET stock = ".$new_stock." WHERE productid = ".$pid;
            $statement = oci_parse($connection, $sql_update);
            oci_execute($statement);
            
            return $quantity;
        }
        
    }

}

function placeOrder($cart, $customer_id, $offer_id = 'NULL', $ship_address, $amountpaid, $total_cost)
{
    $connection = $GLOBALS['db'];
    
    $sql_insert_order = "INSERT INTO ordertable (orderid, customerid, orderdate,
                                                 offerid, status, shippingaddress, totalamount, amountpaid)
                            VALUES (ORDERTABLE_PK.NEXTVAL, ".$customer_id.", CURRENT_TIMESTAMP, 
                                     ".$offer_id.", 'P', '".$ship_address."', ".$amountpaid.", ".$total_cost.")";
    
    echo $sql_insert_order."</br>";
    $statement = oci_parse($connection, $sql_insert_order);
    
    if (oci_execute($statement))
    {
        return true;
    }
    else
    {
        return false;
    }
    
}

 

?>