<?php
session_start();
include 'header.php';

echo "<strong> Here are the items you have ordered. </strong></br>";

echo $_SESSION['cart']."</br>";

// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '</pre>';

$total_cost = 0;

foreach ($_SESSION['cart'] as $pid=>$quantity)
{
    $product = getProductInfo($pid);
    
    $p_name = $product[3];
    $p_cost = $product[4];
    
    echo $p_name . " ". $p_cost . " * " . $quantity. " = ". $p_cost*$quantity;
    echo "</br>";
    
    $total_cost += $p_cost*$quantity;
    
    #echo "This is item: ".$key."</br>";
    #echo "This is item: ".$_SESSION['cart'][1]."</br>";
}

echo "</br><strong>The total cost is: </strong>".$total_cost;



include 'footer.php';
?>