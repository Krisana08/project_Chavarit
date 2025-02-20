<?php
    require_once 'layout/head.php';
    require_once 'db/connect.php';
    $result = $controller->getrentdetail();
?>
<body>
    <div class="container" >  
        <h1>การจัดการเช่า</h1>
        <br>
        <br>
        <table class="table" style="text-align: center;">
        <thead>
            <tr>
            <th scope="col">ห้องเช่า</th>
            <th scope="col">รหัสประจำตัวประชาชน</th>
            <th scope="col">ชื่อผู้เช่า</th>
            <th scope="col">นามสกุล</th>
            <th scope="col">วันที่เริ่ม</th>
            <th scope="col">การจัดการ</th>
            

            </tr>
        </thead>
        <tbody>
            <?php while($row=$result->fetch(PDO::FETCH_ASSOC)){?>
                <tr>
                    <td scope="row"><?php echo $row['rent_id']; ?></td>
                    <td scope="row"><?php echo $row['customer_cardid'] ?></td>
                    <td scope="row"><?php echo $row['customer_name'] ?></td>
                    <td scope="row"><?php echo $row['customer_lastname'] ?></td>
                    <td scope="row"><?php $day = strtotime($row['day']);
                    echo date('d/m/', $day) . (date('Y', $day) + 543);
                    ?>
                    </td>
                    <td scope="row" >
                    <a href="insertbill.php?id=<?php echo $row['rent_id']; ?>"><button type="button" class="btn btn-outline-warning">เพิ่มค่าเช่า</button></a>
                        <a
                        onclick="return confirm('ต้องการลบข้อมุลหรือไม่ ?')"
                        href="deleterent.php?id=<?php echo $row['room_id']; ?>"><button type="button" class="btn btn-outline-danger">ยกเลิก</button></a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</body>
