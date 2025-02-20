<?php
require_once 'layout/head.php';
require_once 'db/connect.php';

// ดึงข้อมูลสรุป
$totalRooms = $controller->countTotalRooms();
$occupiedRooms = $controller->countOccupiedRooms();
$vacantRooms = $totalRooms - $occupiedRooms;
$totalUnpaidBills = $controller->countTotalUnpaidBills();
$totalPaidBills = $controller->countTotalPaidBills();
?>

<div class="container">
    <h1>หน้าจอสรุป</h1>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">จำนวนห้องทั้งหมด</h5>
                    <p class="card-text"><?php echo $totalRooms; ?> ห้อง</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">จำนวนห้องที่มีการเช่า</h5>
                    <p class="card-text"><?php echo $occupiedRooms; ?> ห้อง</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">จำนวนห้องว่าง</h5>
                    <p class="card-text"><?php echo $vacantRooms; ?> ห้อง</p>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-top: 10px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">จำนวนบิลที่ค้างชำระ</h5>
                    <p class="card-text"><?php echo $totalUnpaidBills; ?> บิล</p>
                </div>
            </div>
        </div>
    </div>
</div>

