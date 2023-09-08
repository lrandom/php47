`<?php
require_once 'ABCarEngine.php';
require_once 'ICarInterior.php';

class Car implements ABCarEngine, ICarInterior
{
    public function stopEngine()
    {
        // TODO: Implement stopEngine() method.
        echo "Engine Stopped";
    }

    public function startAirCondition()
    {
        // TODO: Implement startAirCondition() method.
    }

    public function stopAirCondition()
    {
        // TODO: Implement stopAirCondition() method.
    }

    public function startEngine()
    {
        // TODO: Implement startEngine() method.
    }


}
