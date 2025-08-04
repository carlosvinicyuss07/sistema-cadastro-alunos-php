<?php
$host = "localhost";
$dbname = "escola";
$user = "root";
$pass = "1910cvsn";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
