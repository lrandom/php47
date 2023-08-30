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
<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'koodinh@', 'php47');
if (!$conn) {
    die('Không thể kết nối' . mysqli_connect_error());
}

$sql = "SELECT *,products.id as product_id,products.name as product_name,categories.name as category_name FROM products LEFT JOIN categories ON products.category_id = categories.id";
$rs = mysqli_query($conn, $sql);
?>


<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($rs)) {
        ?>
        <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td>
                <?php echo $row['category_name']; ?>
            </td>
            <td>
                <a href="update.php?id=<?php echo $row['product_id']; ?>">Update</a>
                <a onclick="return confirm('Are you sure you want to delete ?')" href="delete.php?id=<?php echo $row['product_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>
