<?php
session_start();
include 'header.php';

if ($_GET['remove_me'])
{
    unset($_SESSION['cart'][$_GET['remove_me']]);
    changeProductStock($_GET['remove_me'], $_GET['quantity'], 'add');
}

echo "<strong> Here are the items you have ordered. </strong></br></br>";

// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '</pre>';

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
}

echo "</table>";


echo "</br><strong>The total cost is: </strong>".$total_cost;



include 'footer.php';
?>