<?php session_start();

    $conn = oci_connect('SYSTEM', 'password', '//localhost/project');
    $stid=oci_parse($conn, "UPDATE PRODUCTS SET STATUS='R' WHERE PRODUCTID = '".$_POST["product"]."'");
    oci_execute($stid);
    oci_close($conn);
?>

<html>
    
    <head>
        <title>Success!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>Retire Successful!<br>
            Click below to return home<br>
            <a href="index.php">Home</a></div>
    </body>
</html>

