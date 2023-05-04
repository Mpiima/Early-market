<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'codememore';

/*** mysql password ***/
$password = 'chaiwadausi';

$dbname='emarket';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
