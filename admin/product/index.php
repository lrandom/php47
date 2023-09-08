<?php
require_once './../../dals/ProductDal.php';//đường dẫn tương đối
$productDal = new ProductDal();
$products = $productDal->getAll();
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
<a href="create.php">Add</a>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product->id; ?></td>
            <td><?php echo $product->name; ?></td>
            <td>
                <a href="update.php?id=<?php echo $product->id; ?>">Update</a>
                <a href="delete.php?id=<?php echo $product->id; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
