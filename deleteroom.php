<?php
    require_once 'db/connect.php';
    if(!isset($_GET['id'])) {
        header("Location: customers.php");
    }else{
        $id = $_GET['id'];
        $result = $controller->deleteroom($id);
        if($result) {
            header("Location: rooms.php");
        }
    }
?>