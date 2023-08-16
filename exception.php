<?php
$a = 10;
$b = 0;
try {
    echo $a / $b;
} catch (Exception $e) {
    echo "Please check b value";
}

?>
