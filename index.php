<?php 
require_once realpath('./vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('./');

$dotenv -> load();

/* 
$host = $_ENV['HOST'];
$port = $_ENV['PORT'];
$database = $_ENV['DB'];
$username = $_ENV['USER'];
$password = $_ENV['PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    echo "Nos conectamos a la nasa :)";
} catch (PDOException $e) {
    echo "No nos pudimos conectar a la nasa :(";
} */


?>