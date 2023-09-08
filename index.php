<?php
echo 'test';
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=php47', 'root', 'koodinh@');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Could not connect.' . $e->getMessage());
}

$prp = $pdo->prepare("INSERT INTO users(name,age,address,password,email) VALUES (:name,:age,:address,:password,:email)");
//$prp->execute([$name, $age, $address, $password, $email]);//chèn và thực thi câu lênnh SQL
$prp->bindParam(':name', $name);
$prp->bindParam(':age', $age);
$prp->bindParam(':address', $address);
$prp->bindParam(':password', $password);
$prp->bindParam(':email', $email);

$name = "Nguyen Van A";
$age = 20;
$address = "Ha Noi";
$password = "123456";
$email = "a@gmail.com";

try {
    $prp->execute();
}catch (PDOException $e){
    echo $e->getMessage();
}


$name = "Nguyen Van B";
$age = 21;
$address = "Ha Noi";
$password = "123456";
$email = "b@gmail.com";

$prp->execute();
