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
//mảng indexed array - > mảng chỉ số nguyên
$programmeLanguages = ["JS", "PHP", "C#"];
$programmeLanguages[] = "Java";
$programmeLanguages[] = "Python";

for ($i = 0; $i < count($programmeLanguages); $i++) {
    echo $programmeLanguages[$i] . "<br>";
}

foreach ($programmeLanguages as $language) {
    echo $language . "<br>";
}

//mảng associative array - > mảng kết hợp hoặc mảng liên hơp
$user = [
    'fullName' => 'Nguyen Van A',
    'age' => 20,
    'address' => 'Ha Noi'
];

foreach ($user as $key => $value) {
    echo $key . " - " . $value . "<br>";
}

//mảng nhiều chiều
$users = [
    'user-1' => [
        'fullName' => 'Nguyen Van A',
        'age' => 20,
        'address' => 'Ha Noi'
    ],
    'user-2' => [
        'fullName' => 'Nguyen Van B',
        'age' => 21,
        'address' => 'Ha Noi'
    ]
];
foreach (users as $user) {
    foreach ($user as $key => $value) {
        echo $key . " - " . $value . "<br>";
    }
}
echo $users['user-1']['age'];
?>
</body>
</html>
