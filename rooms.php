<?php
require_once 'layout/head.php';
require_once 'db/connect.php';
$result = $controller->watchroom();
$totalRooms = $controller->countTotalRooms();
$occupiedRooms = $controller->countOccupiedRooms();
$vacantRooms = $totalRooms - $occupiedRooms;
$totalUnpaidBills = $controller->countTotalUnpaidBills();
$totalPaidBills = $controller->countTotalPaidBills();
?>
<body>
    <br>
    <div class="container">
    <h1>สรุปผล</h1>
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
            <a href="billstatusOwe.php">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">จำนวนบิลที่ค้างชำระ</h5>
                        <p class="card-text"><?php echo $totalUnpaidBills; ?> บิล</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<br>
    <div class="container">
        <div class="header">
            <h1>การจัดการห้องเช่า</h1>
            <br>
            <a href="insertrooms.php"><button type="button" class="btn btn-outline-primary">เพิ่มห้องเช่า</button></a>
            <br>
            <br>
        </div>
        <br>

        <div class="rooms">
            <?php 
            $currentFloor = null;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                $floor = floor($row['room_id'] / 100);
                if ($currentFloor !== $floor) {
                    if ($currentFloor !== null) {
                        echo '</div><br>'; // ปิด div ชั้นก่อนหน้าและเพิ่มบรรทัดใหม่
                    }
                    $currentFloor = $floor;
                    echo '<h2 class="floor-header">ชั้น ' . $currentFloor . '</h2>';
                    echo '<div class="floor" >'; // เปิด div ชั้นใหม่
                }
            ?>
                <div class="room-container">
                    <div class="room-id"><?php echo $row['room_id']; ?></div>
                    <a href="#" data-toggle="modal" data-target="#roomModal<?php echo $row['room_id']; ?>">
                        <?php if($row['status'] == '0') {
                            echo '<img src="image/Green.png" alt="รูปภาพ" style="width: 100px; height: 100px;">';
                        } else {
                            echo '<img src="image/Red.png" alt="รูปภาพ" style="width: 100px; height: 100px;">';
                        } ?>
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="roomModal<?php echo $row['room_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel<?php echo $row['room_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="roomModalLabel<?php echo $row['room_id']; ?>">รายละเอียดห้อง <?php echo $row['room_id']; ?></h5>
                            </div>
                            <div class="modal-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#details<?php echo $row['room_id']; ?>" role="tab">รายละเอียดห้อง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#rentDetails<?php echo $row['room_id']; ?>" role="tab">รายละเอียดการเช่า</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#billDetails<?php echo $row['room_id']; ?>" role="tab">ประวัติการชำระเงิน</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="details<?php echo $row['room_id']; ?>" role="tabpanel">
                                        <p>สถานะ: <?php echo ($row['status'] == '0') ? "ว่าง" : "มีการเช่า"; ?></p>
                                    </div>
                                    <div class="tab-pane" id="rentDetails<?php echo $row['room_id']; ?>" role="tabpanel" >
                                        <?php
                                        // ดึงข้อมูลรายละเอียดการเช่า
                                        if ($row['status'] != '0') {
                                            $rentDetails = $controller->getrent($row['room_id']);
                                            if ($rentDetails) {
                                                echo '<p>รายละเอียดการเช่า:</p>';
                                                echo '<ul>';
                                                echo '<ul>ชื่อผู้เช่า: ' . $rentDetails['customer_name'] . '</ul>';
                                                echo '<ul>นามสกุลผู้เช่า: ' . $rentDetails['customer_lastname'] . '</ul>';
                                                $day = strtotime($rentDetails['day']);
                                                echo '<ul>วันที่เริ่มเช่า: ' . date('d/m/', $day) . (date('Y', $day) + 543) . '</ul>';
                                                echo '</ul>';
                                            } else {
                                                echo '<p>ไม่พบรายละเอียดการเช่า</p>';
                                            }
                                        } else {
                                            echo '<p>ห้องนี้ยังไม่มีการเช่า</p>';
                                        }
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="billDetails<?php echo $row['room_id']; ?>" role="tabpanel" >
                                        <?php
                                        // ดึงข้อมูลรายละเอียดการชำระเงิน
                                            $unpaidCount = $controller->countUnpaidBills($row['room_id']);
                                            $fisnihedCount = $controller->countFinishedBills($row['room_id']);
                                            if ($fisnihedCount > 0) {
                                                echo '<p>รายละเอียดการชำระเงิน:</p>';
                                                echo '<ul>';
                                                echo '<ul>ชำระแล้ว: ' . $fisnihedCount . ' ครั้ง</ul>';
                                                echo '</ul>';
                                            }
                                            if ($unpaidCount > 0) {
                                                echo '<ul>';
                                                echo '<ul>ค้างชำระ: ' . $unpaidCount . ' ครั้ง</ul>';
                                                echo '</ul>';
                                            } else {
                                                echo '<p>ไม่มีการค้างชำระ</p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php if($row['status'] == '0') { ?>
                                    <a href="insertrent.php?id=<?php echo $row['room_id']; ?>"><button type="button" class="btn btn-primary">เช่า</button></a>
                                <?php } ?>
                                <a href="billdetailforroom.php?id=<?php echo $row['room_id']; ?>"><button type="button" class="btn btn-primary">ประวัติการชำระเงินเพิ่มเติม</button></a>
                                <?php if($row['status'] == '1') { ?>
                                    <a href="insertbill.php?id=<?php echo $row['room_id']; ?>"><button type="button" class="btn btn-outline-warning">เพิ่มค่าเช่า</button"></a>
                                    <a
                                    onclick="return confirm('ต้องการลบข้อมุลหรือไม่ ?')"
                                    href="deleterent.php?id=<?php echo $row['room_id']; ?>"><button type="button" class="btn btn-outline-danger">ยกเลิก</button>
                                    </a>
                                <?php } ?>
                                
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div> <!-- ปิด div ชั้นสุดท้าย -->
    </div>
</body>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
