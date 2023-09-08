<?php

class Human
{
    var $name;
    var $height;
    var $weight;
    var $gender;
    var $age;
    var $hairColor;
    var $eyeColor;

    static function getClassName()
    {
        return "Human";
    }

    //get/setter
    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setAge($age)
    {
        if ($age > 120) {
            throw new Exception("Tuổi không hợp lệ");
        }
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed|string
     */
    public function getHairColor()
    {
        return $this->hairColor;
    }

    /**
     * @param mixed|string $hairColor
     */
    public function setHairColor($hairColor): void
    {
        $this->hairColor = $hairColor;
    }

    /**
     * @return mixed|string
     */
    public function getEyeColor()
    {
        return $this->eyeColor;
    }

    /**
     * @param mixed|string $eyeColor
     */
    public function setEyeColor($eyeColor): void
    {
        $this->eyeColor = $eyeColor;
    }


    public function __construct($name, $age, $height, $weight, $hairColor = "black", $eyeColor = "black")
    {
        $this->name = $name;
        $this->age = $age;
        $this->height = $height;
        $this->weight = $weight;
        $this->hairColor = $hairColor;
        $this->eyeColor = $eyeColor;
    }

    function __destruct()
    {
        echo "hủy object";
    }

    //hành vi/ hành động/ phương thức/ method /behavior
    public function study()
    {
        echo $this->name . ' study';
    }

    function sleep()
    {
        echo $this->name . ' sleep';
    }

    function eat()
    {
        echo $this->name . ' eat';
    }

}

