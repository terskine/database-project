<?php

$connection = oci_connect('maurice', 'admin', '//localhost/XE');

$GLOBALS['db'] = $connection;
?>