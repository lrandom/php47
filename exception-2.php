<?php
function divide($a, $b)
{
    if ($b == 0) {
        throw new Exception("Please check b value");
    }
    return $a / $b;
}

try {
    divide(10, 0);
} catch (Exception $exception) {
    echo "Vui long nhap so b khac 0";
}

?>
