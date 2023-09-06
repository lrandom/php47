<?php
$id = $_GET['id'];
if(!$id || !is_numeric($id)) {
    header('Location: list.php');
}
require_once 'connectDB.php';
mysqli_query($conn, "DELETE FROM products WHERE id = $id");
header('Location: list.php');
?>
