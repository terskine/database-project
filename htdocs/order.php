<?php
session_start();
include 'header.php';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (placeOrder($_SESSION['cart'], $_SESSION['CUSTOMERID'], 'NULL', $_SESSION['ADDRESS'], $_SESSION['total_cost'], $_SESSION['total_cost']))
{
    unset($_SESSION['cart']);
    echo "Thank you for placing your order!";
    
}
else
{
    echo "Error upon ordering.";
}


include 'footer.php';


?>