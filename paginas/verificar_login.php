<?php
session_start();
if(!$_SESSION['usuario']){
    header('Location: login.php');
    exit(); 
}else{
    header('Location: ../index.php');
}
?>