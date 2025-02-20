<?php
    require_once 'db/connect.php';
    if(!isset($_GET['id'])) {
        header("Location: billstatusOwe.php");
    }else{
        $id = $_GET['id'];
        $result = $controller->deletebill($id);
        if($result) {
            header("Location: billstatusOwe.php");
        }
    }
?>