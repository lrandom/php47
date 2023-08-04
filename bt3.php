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
//số nt là số % 1 và chính nó
//bubble sort
for ($i = 0; $i < count($arr) - 1; $i++) {
    for ($j = $i + 1; $j < count($arr); $j++) {
        if ($arr[$i] < $arr[$j]) {
            $tmp = $arr[$i];//giá trị cốc 1
            $arr[$i] = $arr[$j];
            $arr[$j] = $tmp;
        }
    }
}

foreach ($arr as $item) {
    echo $item. " <br>";
}
?>
</body>
</html>
