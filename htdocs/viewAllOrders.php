<?php
session_start();
include 'header.php';


if ($_GET['clear_order'])
{
    clearOrder($_GET['clear_order']);
}

$statement = getAllOrders();

echo 'Clear Orders<br>';
echo '<table style="width:500px">';
echo '<tr>';
echo '<td><strong>Order ID</strong></td>';
echo '<td><strong>Customer ID</strong></td>';
echo '<td><strong>Order Date</strong></td>';
echo '<td><strong>Total Amount</strong></td>';
echo '<td><strong>Amount Paid</strong></td>';
echo '<td><strong>Status</strong></td>';
echo '</tr>';

while($row = oci_fetch_array($statement, OCI_BOTH))
{
    echo '<tr>';
    $order_id = $row[0];
    $customer_id = $row[1];
    $order_date = $row[2];
    $total_amount = $row[4];
    $amount_paid = $row[5];
    $status = $row[6];

    $link = '<a href="clearOrder.php?order_id='.$order_id.'">'.$order_id.'</a>';

    echo '<td>'.$link .'</td>';
    echo '<td>'.$customer_id .'</td>';
    echo '<td>'.$order_date .'</td>';
    echo '<td>'.$total_amount .'</td>';
    echo '<td>'.$amount_paid .'</td>';
    echo '<td>'.$status .'</td>';

    echo '</tr>';
}

echo "</table>";


include 'footer.php';
?>