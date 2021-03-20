<?php require "./crud/user.php";
if(!isset( $_GET["id"])){
    echo "Sorry you can't browse this page directly";
    die;
};
$user = new User();
$user->deleteUser( $_GET["id"]);