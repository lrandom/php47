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
require_once 'dals/DB.php';
$db = new DB();
$pdo = $db->getPdo();
//turn off auto-commit
$pdo->beginTransaction();
try {
    $pdo->query("INSERT INTO categories (name) VALUES ('Phần mềm')");
    $pdo->query("INSERT INTO products (name,category_id) VALUES ('Phần mềm diệt virus Kaspersky',1)");
    $pdo->commit();//đẩy dữ liê vào bảng
} catch (PDOException $e) {
    echo $e->getMessage();
    $pdo->rollBack();//hủy bỏ dữ liệu
}

$data = $pdo->query('CALL getCategory()');
$categories = $data->fetchAll(PDO::FETCH_OBJ);
foreach ($categories as $category) {
    echo $category->name;
    echo '<br/>';
}
?>
</body>
</html>
