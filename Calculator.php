<?php

class Calculator
{
    public function add()
    {
        $argsCounter = count(func_get_args());
        if ($argsCounter == 2) {
            return func_get_arg(0) + func_get_arg(1);
        }
        if ($argsCounter == 3) {
            return func_get_arg(0) + func_get_arg(1) + func_get_arg(2);
        }
    }
}

$calculator = new Calculator();
$calculator->add(1, 2);
$calculator->add(1, 2, 3);

?>
