<?php
require_once 'Human.php';

class Student extends Human
{
    var $studentId;

    function goToSchool()
    {
        echo $this->name . 'go to school';
    }

    //override - dynamic polymorhphism
    function study()
    {
        echo "Student Study";
    }
}

//đơn kế thừa
//đa kế thừa
//chimera

?>
