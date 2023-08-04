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
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
foreach ($arr as $item) {
    $total = 0;
    //đi tìm ước cho $item
    for ($i = 1; $i < $item; $i++) {
        //chia hết thì là ước
        if ($item % $i == 0) {
            $total += $i;
        }
    }
    if ($total == $item) {
        echo $item . " là số hoàn hảo<br>";
    } else {
        echo $item . " không phải là số hoàn hảo<br>";
    }
}
?>
</body>
</html>
