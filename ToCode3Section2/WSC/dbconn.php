<?php

$host         = "localhost";
$username     = "root";
$password     = "mysql";
$dbname       = "dbReservation";

try {
    $dbconn = new PDO('mysql:host=localhost;dbname=dbReservation', $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
