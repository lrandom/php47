<?php
$conn = mysqli_connect('127.0.0.1', 'root', 'koodinh@', 'php47');
if (!$conn) {
    die('Không thể kết nối' . mysqli_connect_error());
}
$rsCategories = mysqli_query($conn, "SELECT * FROM categories");
$categories = [];
while($category = mysqli_fetch_assoc($rsCategories)) {
    $categories[] = $category;
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $categoryId = $_POST['category_id'];
    $sql = "INSERT INTO products (name,category_id) VALUES('$name',$categoryId)";
    //INSERT INTO products (name) VALUES ('iPhone 11')
    mysqli_query($conn, $sql);
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
    <input type="text" name="name" placeholder="Name">
    <br>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
