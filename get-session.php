<?php
session_start();
if(isset($_SESSION['user'])) {
    echo 'Hello ' . $_SESSION['user']['name'];
} else {
    echo 'You are not logged in';
}
?>
