<?php

include "./db_connect.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    echo "A főoldalon foglalhat!";
    header("Location: index.php");
    die();
} else {
    $space = $_POST['res_space'] ?? null;
    $reserver = $_POST['res_reserver'] ?? null;
    $start_date = $_POST['res_start_date'] ?? null;
    $start_time = $_POST['res_start_time'] ?? null;
    $end_date = $_POST['res_end_date'] ?? null;
    $end_time = $_POST['res_end_time'] ?? null;

    // Időpontok átalakítása az adatbázishoz
    $start_time_str = $start_date . ' ' . $start_time . ':00';
    $end_time_str = $end_date . ' ' . $end_time . ':00';

    $sql = "INSERT INTO `reservations` (`space`, `reserver`, `start_time`, `end_time`) VALUES (?, ?, ?, ?);";
    $stmt = CONN->prepare($sql);
    $stmt->bindParam(1, $space, PDO::PARAM_INT);
    $stmt->bindParam(2, $reserver, PDO::PARAM_STR);
    $stmt->bindParam(3, $start_time_str, PDO::PARAM_STR);
    $stmt->bindParam(4, $end_time_str, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        echo "Nem sikerült végrehajtani!";
    } else {
        echo "
        <h1>Sikeres foglalás!</h1>
        <a href='./index.php'>Vissza</a>
        ";
    }
}
