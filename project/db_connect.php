<?php
$db_server = "db";
$db_user   = "root";
$db_psw    = "";
$db_name   = "parking_reservation";

try {
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_psw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database Error:\n" . $e->getMessage();
}
define("CONN", $conn);