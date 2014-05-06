<?php
session_start();
include 'header.php';

#if ($_SESSION['user'] == )

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

if ($_GET['order_id'])
{
    $statement = getOrder($_GET['order_id']);
    $clear_flag = 1;
    echo 'Clear Orders<br>';
    echo '<table style="width:500px">';
    echo '<tr>';
    echo '<td><strong>Item ID</strong></td>';
    echo '<td><strong>Order ID</strong></td>';
    echo '<td><strong>Product Name</strong></td>';
    echo '<td><strong>Quantity</strong></td>';
    echo '<td><strong>Stock</strong></td>';
    echo '<td><strong>Reorder level</strong></td>';
    echo '</tr>';
    
    while($row = oci_fetch_array($statement, OCI_BOTH))
    {
        echo '<tr>';
        $item_id = $row[0];
        $order_id = $row[1];
        $product_name = $row[2];
        $quantity = $row[3];
        $stock = $row[4];
        $reorder_level = $row[5];
        
        if ($reorder_level > $stock)
        {
            $clear_flag = 0;
        }
        
        $link = '<a href="product.php?product_id='.$pid.'">'.$p_name.'</a>';
    
        echo '<td>'.$item_id .'</td>';
        echo '<td>'.$order_id .'</td>';
        echo '<td>'.$product_name .'</td>';
        echo '<td>'.$quantity .'</td>';
        
        if ($clear_flag == 0)
        {
            echo '<td><span style="color:red; font-weight:bold">'.$stock .'</span></td>';
            echo '<td><span style="color:red; font-weight:bold">'.$reorder_level .'</span></td>';
        }
        else
        {
            echo '<td>'.$stock .'</td>';
            echo '<td>'.$reorder_level .'</td>';
        }
        
        echo '</tr>';
    }
    
    echo "</table>";
    echo "</br></br>";
    
    if ($clear_flag)
    {
        echo '<form id="ClearOrder" action="viewAllOrders.php?clear_order='.$_GET['order_id'].'" method="post">';
        echo '<input type="submit" value="Clear Order" />';
        echo '</form>';
    }
    else
    {
        echo "Cannot clear order due to stock level.";
    }
    
}
$link = '<a href="product.php?product_id='.$pid.'">'.$p_name.'</a>';

echo '</br></br><a href="viewallorders.php">View All Orders</a>';



include 'footer.php';
?>