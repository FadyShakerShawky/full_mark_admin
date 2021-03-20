<?php

require './crud/teacher.php';
$user = new Teacher();
$id = filter_input(INPUT_GET , 'u_id' , FILTER_SANITIZE_NUMBER_INT);
$users = $user->deleteTeacher($id);
header("Location:list student.php");
?>