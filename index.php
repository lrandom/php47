<?php
require_once 'Human.php';
require_once 'Student.php';

$luan = new Student("Luân", 30, "1.72m", "75");//tạo ra một đối tợng luân
/*$luan->name = "Luân";
$luan->age = 30;
$luan->height = "1.72m";
$luan->weight = 75;*/
//$luan->name = "Luân";
$luan->study();
//$luan->eat();
//$luan->sleep();
//$luan->goToSchool();
//$luan->name = "Luan";

//echo $luan->name;
$luan->setName("Luan");
echo $luan->getName();


$binh = new Student("Bình", 20, "1.72", "70");
/*$binh->name = "Bình";
$binh->age = 20;
$binh->height = "1.72m";
$binh->weight = 70;*/

$binh->study();
//$binh->eat();
//$binh->sleep();
//$binh->goToSchool();

echo Human::getClassName();
