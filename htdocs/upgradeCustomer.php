<?php session_start();

include 'header.php';
?>

<form action="validateUpgrade.php" method="post">
    Customer Type: <select name="customerType" required>
        <option value="S">S</option>
        <option value="G">G</option>
        <option value="P">P</option>
    </select><br>
    Starting Date:<input type="date" name="startingDate" required><br>
    Ending Date: <input type="date" name="endingDate" required><br>
    Amount Purchased: <input type="number" min="1" name="amount"><br>
    <input type="submit" value="Submit">
</form>


<?php 

include 'footer.php';
?>