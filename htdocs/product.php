<?php

session_start();
include 'header.php';

if ($_POST['quantity'])
{
    
    $new_stock = changeProductStock($_SESSION['viewing_product_id'], $_POST['quantity'], 'sub');
    
    if ($new_stock != 0)
    {
        echo "You have successfully placed an order! </br></br>";
        $_SESSION['cart'][$_SESSION['viewing_product_id']] = $new_stock;
    }
    else
    {
        echo "Sorry the product is out of stock!</br></br>";
    }
    
    
}

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

echo "<strong>Name: </strong>".$p_name;
echo "</br>";
echo "<strong>Cost: </strong>".$p_cost;
echo "</br>";
echo "<strong>Warrenty: ".$p_warrenty." months</strong>";
echo "</br>";
echo "<strong>".$p_stock." left in stock</strong>";

if ($_SESSION['cart'][$_SESSION['viewing_product_id']])
{
    echo "</br>Remove product in cart to adjust quantity you want to purcahse.</br>";
}
else
{
    echo '<form id="Product" action="product.php" method="post">';
    echo 'Quantity: <input type="text" name="quantity" />';
    echo '<input type="submit" value="Add To Cart." />';
    echo '</form>';
}

include 'footer.php';
?>
