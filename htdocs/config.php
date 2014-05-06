<?php

$connection = oci_connect('SYSTEM', 'password', '//localhost/project');

$GLOBALS['db'] = $connection;
?>