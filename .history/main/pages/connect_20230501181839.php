<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

$dbname='emarket1';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
