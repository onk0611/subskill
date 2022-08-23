<?php 

$server = 'localhost';
$db_name = 'subskill';

$username = 'root';
$password = '';

try {
    $db = new PDO('mysql:host=' . $server . ';dbname=' . $db_name . ';charset=utf8', $username, $password);
    echo '<div class="connection-established"><i class="fa-solid fa-circle-check"></i> Database connection established.</div>';
} catch (PDOException $e) {
    echo '<div class="connection-not-established"><i class="fa-solid fa-circle-xmark"></i> Database connection not established.</div>';
    die('Erreur : ' . $e->getMessage());
}
