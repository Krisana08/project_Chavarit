<?php
require_once 'db/connect.php';

if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];

    // สร้างออบเจ็กต์ของคลาส Controller
    $controller = new Controller($pdo);

    // อัปเดตสถานะการชำระเงิน
    $result = $controller->updatestatusbill($payment_id);

    if ($result) {
        echo "<script>alert('อัปเดตสถานะการชำระเงินสำเร็จ'); window.location.href='billstatusOwe.php';</script>";
    } else {
        echo "<script>alert('อัปเดตสถานะการชำระเงินไม่สำเร็จ'); window.location.href='billstatusOwe.php';</script>";
    }
} else {
    echo "<script>alert('ไม่พบ ID ของบิล'); window.location.href='billstatusOwe.php';</script>";
}
?>