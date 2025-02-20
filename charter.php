<?php
    require_once 'layout/head.php';
    require_once 'db/connect.php';
    $result = $controller->getcharter();
?>
<body>
    <div class="container" >  
        <h1>การจัดการสัญญาเช่า</h1>
        <br>
        <br>
        <div>
            <a href="insertcharter.php"><button type="button" class="btn btn-outline-primary">เพิ่มสัญญาเช่า</button></a>
        </div>
        <br>
        <table class="table table-dark table-sm" style="text-align: center;">
        <thead>
            <tr>
            <th scope="col">รหัสสัญญาเช่า</th>
            <th scope="col">วันที่เริ่ม</th>
            <th scope="col">วันที่ออก</th>
            <th scope="col">รหัสการเช่า</th>
            <th scope="col">จัดการสัญญา</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=$result->fetch(PDO::FETCH_ASSOC)){?>
                <tr>
                    <td scope="row"><?php echo $row['charter_id']; ?></td>
                    <td scope="row"><?php $start_day = strtotime($row['start_day']);
                    echo date('d/m/', $start_day) . (date('Y', $start_day) + 543);
                    ?></td>
                    <td scope="row"><?php $out_day = strtotime($row['out_day']);
                    echo date('d/m/', $out_day) . (date('Y', $out_day) + 543);
                    ?></td>
                    <td scope="row"><?php echo $row['rent_id']; ?></td>
                    <td scope="row" >
                        <a href="charterpaper.php?charter_id=<?php echo $row['charter_id']; ?>"><button type="button" class="btn btn-outline-info">เอกสารสัญญาเช่า</button></a>
                        <a
                        onclick="return confirm('ต้องการลบข้อมุลหรือไม่ ?')"
                        href="deletecharter.php?id=<?php echo $row['charter_id']; ?>"><button type="button" class="btn btn-outline-danger">ยกเลิก</button></a>
                    </td>
                </tr>
            <?php }?>
            
        </tbody>
    </table>
</body>