<?php
session_start();
include 'header.php';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if ($_GET['remove_me'])
{
    unset($_SESSION['cart'][$_GET['remove_me']]);
    changeProductStock($_GET['remove_me'], $_GET['quantity'], 'add');
}

echo "<strong> Here are the items you have ordered. </strong></br></br>";

$total_cost = 0;

echo '<table style="width:500px">';
echo '<tr>';
echo '<td><strong>Name</strong></td>';
echo '<td><strong>Cost</strong></td>';
echo '<td><strong>Stock</strong></td>';
echo '<td><strong>Total Payment</strong></td>';
echo '<td><strong>Remove</strong></td>';
echo '</tr>';

foreach ($_SESSION['cart'] as $pid=>$quantity)
{
    $product = getProductInfo($pid);
    
    $p_name = $product[3];
    $p_cost = $product[4];
    
    $remove_me = '<a href="checkout.php?remove_me='.$pid.'&quantity='.$quantity.'">Remove me</a>';
    
    echo '<tr>';
    echo '<td>'.$p_name.'</td>';
    echo '<td>'.$p_cost.'</td>';
    echo '<td>'.$quantity.'</td>';
    echo '<td>'.$p_cost*$quantity.'</td>';
    echo '<td>'.$remove_me.'</td>';
    echo '</tr>';
    
    $total_cost += $p_cost*$quantity;
    $_SESSION['total_cost'] = $total_cost;
}

echo "</table>";


echo "</br><strong>The total cost is: </strong>".$total_cost;

if (!empty($_SESSION['cart']))
{
    echo '<form id="Order" action="order.php" method="post">';
    echo '<input type="submit" value="Place Order" />';
    echo '</form>';
}

include 'footer.php';
?>