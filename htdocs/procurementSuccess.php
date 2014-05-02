<?php session_start(); 
include 'header.php';?>


        <div> Procurement was successful!<br>
            New procurement id: <?php echo $_GET["id"];?><br>
            Click below to return home.<br>
            <a href="index.php">Home</a></div>
<?php include 'footer.php';?>
