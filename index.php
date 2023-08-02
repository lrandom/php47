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
define("PI", 3.14);
define("RADIUS", 360);

echo "Hello World";
echo 10 + 20;

//under_score -> python function
//camelCase -> variable name
//PascalCase -> class name

$myFullName = "Nguyen Thanh Luan";
$myJob = "Developer";

echo "<h1>" . $myFullName . "</h1>";
echo "<p class='text-bold text-red'>" . $myJob . "</p>";
echo PI * RADIUS;
?>
</body>

<style>
    .text-bold {
        font-weight: bold;
    }

    .text-red {
        color: red;
    }
</style>
</html>
