<?php
$id = $_GET['id'];
if(!$id || !is_numeric($id)) {
    header('Location: list.php');
}
$conn = mysqli_connect('127.0.0.1', 'root', 'koodinh@', 'php47');
if (!$conn) {
    die('Không thể kết nối' . mysqli_connect_error());
}
mysqli_query($conn, "DELETE FROM products WHERE id = $id");
header('Location: list.php');
?>
