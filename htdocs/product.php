<?php

session_start();
include 'header.php';

if ($_GET['product_id'])
{
    $product = getProductInfo($_GET['product_id']);
    $p_name = $product[3];
    $p_cost = $product[4];
    $p_warrenty = $product[5];
    $p_stock = $product[6];
    
    $_SESSION['viewing_product_id'] = $_GET['product_id'];
}
else if ($_SESSION['viewing_product_id'])
{
    $product = getProductInfo($_SESSION['viewing_product_id']);
    $p_name = $product[3];
    $p_cost = $product[4];
    $p_warrenty = $product[5];
    $p_stock = $product[6];
}

if ($_POST['quantity'])
{
    echo "You have successfully placed an order! </br>";
    
    $_SESSION['cart'][$_SESSION['viewing_product_id']] = $_POST['quantity'];
}

/*
 * Get product page
 */

// echo "MY SESSION: ";
// echo "</br>";
// echo "viewing: ".$_SESSION['viewing_product_id'];
// echo "</br> ".$_SESSION['cart'][$_SESSION['viewing_product_id']];


echo "<strong>Name: </strong>".$p_name;
echo "</br>";
echo "<strong>Cost: </strong>".$p_cost;
echo "</br>";
echo "<strong>Warrenty: ".$p_warrenty." months</strong>";
echo "</br>";
echo "<strong>".$p_stock." left in stock</strong>";

?>

<form id="Product" action="product.php" method="post"> 
    Quantity: <input type="text" name="quantity" /> 
    <input type="submit" value="Add To Cart." /> 
</form>

<?php
    
include 'footer.php';
        
?>