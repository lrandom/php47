<?php
if (isset($_FILES['image']) && $_FILES['image']['name'] != null) {
    //upload file
    $file = $_FILES['image'];
    $uploadPath = 'uploads/' . date('d-m-Y') . '/';
    if (!is_dir($uploadPath) || !file_exists($uploadPath)) {
        mkdir($uploadPath);
    }
    move_uploaded_file($file['tmp_name'], $uploadPath . time() . $file['name']);
}
?>
