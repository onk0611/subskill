<?php 

$username = 'root';
$password = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=subskill;charset=utf8', $username, $password);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}