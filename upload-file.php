<?php
if (isset($_FILES['image']) && $_FILES['image']['name'] != null) {
    //upload file
    $file = $_FILES['image'];
    move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
}
?>
