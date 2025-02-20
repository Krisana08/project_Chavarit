<?php
    require_once 'db/connect.php';
    require_once 'layout/head.php';
    if(!isset($_GET['id'])) {
        header("Location: customers.php");
    }else{
        $id = $_GET['id'];
        $emp = $controller->change($id);
        
    }
?>