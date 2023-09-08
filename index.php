<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=php47', 'root', 'koodinh@');
} catch (PDOException $e) {
    die('Could not connect.'.$e->getMessage());
}
