<?php
session_start();
include 'header.php';

if (placeOrder($_SESSION['cart'], $_SESSION['CUSTOMERID'], 'NULL', $_SESSION['ADDRESS'], $_SESSION['amount_paid'], $_SESSION['total_cost']))
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