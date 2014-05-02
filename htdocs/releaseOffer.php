<?php session_start();
    include './utilityFunctions.php';
    include 'header.php'?>

<form name="offer" action="validateOffer.php" method="post">
    *Type: <select name="type" required>
        <option value="S">S</option>
        <option value="G">G</option>
        <option value="P">P</option>
    </select><br>
    *Country: <?php getCountries() ?><br>
    *Validity: <input type="number" name="validity" min="1" max="99" step="1" required><br>
    *Discount: <input type="number" name="discount" min="1" max="99" step="1" required><br>
    *Effective Date: <input type="date" name="date" required><br>
    *Description: <input type="text" name="description" maxlength="30" required><br>
    <input type="submit" value="Submit">
    <div>* Indicates required field</div>
</form>


<?php include 'footer.php';?>