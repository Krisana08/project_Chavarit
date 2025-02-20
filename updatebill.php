<?php
require_once 'db/connect.php';
    if(isset($_POST['update'])) {
        $id = $_POST['payment_id'];
        $room_id = $_POST['room_id'];
        $month = $_POST['month'];
        $elect_first = $_POST['elect_first'];
        $elect_last = $_POST['elect_last'];
        $water_first = $_POST['water_first'];
        $water_last = $_POST['water_last'];
        $water_price = $_POST['water_price'];
        $elect_price = $_POST['elect_price'];
        $total_price = $_POST['total_price'];
        $status_payment = $_POST['status_payment'];

        $result = $controller->updatebill($id, $room_id, $month, $elect_first, $elect_last, $water_first, $water_last, $water_price, $elect_price, $total_price, $status_payment);
        if ($result) {
            header("Location: billstatusOwe.php");
            
        }
    }
?>