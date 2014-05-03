<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); 
include 'header.php';?>
<html>
    
    <head>
        <title>Success!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>Success!<br>
            <?php echo $_GET["a"]?> proposals accepted.<br>
            <?php echo $_GET["r"]?> proposals rejected.<br>
            Click below to return home<br>
            <a href="index.php">Home</a></div>
    </body>
</html>

<?php include 'footer.php';?>
