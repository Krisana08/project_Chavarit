<?php
    require_once 'db/connect.php';
    if(!isset($_GET['id'])) {
        header("Location: charter.php");
    }else{
        $id = $_GET['id'];
        $result = $controller->deletecharter($id);
        if($result) {
            header("Location: charter.php");
        }
    }
?>