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
foreach ($arr as $item) {
    if ($item == 1) {
        echo $item . " không phải là số nguyên tố<br>";
        continue;
    }

    $isPrime = true;
    ///check xem $item là số nguyên tố hay không trong trường hợp hợp >=2
    for ($i = 2; $i < $item; $i++) {
        if ($item % $i == 0) {
            //xuất hiện 1 ước thứ 3 và thoát vòng lặp
            $isPrime = false;
            break;
        }
    }
    if ($isPrime) {
        echo $item . " là số nguyên tố<br>";
    } else {
        echo $item . " không phải là số nguyên tố<br>";
    }
}
?>
</body>
</html>
