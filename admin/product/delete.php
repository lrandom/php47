<?php
if (isset($_GET['id'])) {
    require_once './../../dals/ProductDal.php';
    $productDal = new ProductDal();
    $id = $_GET['id'];
    $productDal->delete($id);
    header('Location: index.php');
    exit();
}
?>
