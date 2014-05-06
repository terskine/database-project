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
    $sql_text = "SELECT * FROM products WHERE STATUS='A'";
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    
    return $statement;
}

function getAllOrders()
{
    $connection = $GLOBALS['db'];
    $sql_text = "SELECT * FROM ordertable";
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    
    return $statement;
}

function getOrder($order_id)
{
    $connection = $GLOBALS['db'];
    $sql_text = "SELECT i.itemid,i.orderid,p.name,i.quantity,p.stock,p.reorderlevel FROM item i LEFT JOIN products p ON p.productid = i.productid WHERE i.orderid = ".$order_id;
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
    
    $statement = oci_parse($connection, $sql_insert_order);
    
    if (oci_execute($statement))
    {
    }
    else
    {
        return false;
    }
    
    $sql_text = 'select orderid from ordertable where ROWNUM = 1 order by orderid desc';
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    $row = oci_fetch_array($statement, OCI_BOTH);
    $order_id = $row[0];
    
    foreach ($cart as $pid=>$quantity)
    {
        $sql_insert_item = "INSERT INTO item (itemid, orderid, productid, quantity)
                            VALUES (ITEM_PK.NEXTVAL, ".$order_id.", ".$pid.", ".$quantity.")";
        echo "THis is sql: ".$sql_insert_item;
        $statement = oci_parse($connection, $sql_insert_item);
        oci_execute($statement);
    }
    
    return true;
    
}


function clearOrder($order_id)
{
    $connection = $GLOBALS['db'];
    $sql_text = "UPDATE ordertable SET status = 'C' WHERE orderid = ".$order_id;
    //echo "this is text: ".$sql_text;
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
}

function getAllOffers($country_id, $type)
{
    $connection = $GLOBALS['db'];
    
    $sql_text = "SELECT * FROM offer WHERE countryid = ".$country_id." AND type = '".$type."' AND launchdate + validity > CURRENT_TIMESTAMP AND launchdate < CURRENT_TIMESTAMP";
    $statement = oci_parse($connection, $sql_text);
    oci_execute($statement);
    
    return $statement;
}

?>