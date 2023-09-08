<?php
if (isset($_POST['name'])) {
    require_once './../../dals/ProductDal.php';
    require_once './../../models/Product.php';
    $productDal = new ProductDal();
    $name = $_POST['name'];
    $product = new Product();
    $product->setName($name);
    $productDal->create($product);
    header('Location: index.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <input type="text" name="name" placeholder="Name"/>
    <button>Submit</button>
</form>
</body>
</html>
