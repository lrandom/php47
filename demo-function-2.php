<?php
//truyền tham trị

//truyền tham chiếu
function total(&$a, &$b)
{
    $a = 20;
    $b = 40;
    return $a + $b;
}

$c = 10;
$d = 20;

echo total($c, $d).  PHP_EOL;
echo $c .  PHP_EOL;;
echo $d .  PHP_EOL;;
