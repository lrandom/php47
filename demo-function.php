<?php

function totalNumber($a, $b)
{
    $total = $a + $b;
    return $total;
}

$total = totalNumber(
    10, 20
);

echo $total;

//7.4
//lamda function
//anounymous function
//first citizen function -> function can be used as a variable
$totalNumber = function ($a, $b) {
    $total = $a + $b;
    return $total;
};
echo $totalNumber(10, 20);

function higherOrderFunction($a,$b,$callback)
{
    $total = $a + $b;
    $callback($total);
}


higherOrderFunction(10,40,function($total){
    echo $total;
    echo $total * 2;
});

higherOrderFunction(10, 40, function ($total) {
    echo $total;
    echo $total * 3;
});
