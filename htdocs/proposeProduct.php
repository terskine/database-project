<?php session_start();
include 'header.php';
include './utilityFunctions.php';

if ($_GET["err"] == "true") {
    echo 'Error: Product/proposal with that name already exists!<br>';
}
?>


Propose Product<br>
<form action="validateProposal.php" method="post">
    Product Name: <input type="text" name="name" maxlength="25" required><br>
    Category: <?php    getCategories(); ?><br>
    <input type="submit" value="Submit">
</form>




<?php include 'footer.php'?>
