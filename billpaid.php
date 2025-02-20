<?php
require_once 'layout/head.php';
require_once 'db/connect.php';
$result = $controller->watchpaymentPaid();
?>
<body>
    <div class="container">
        <h1>ประวัติการชำระเงิน</h1>
        <br>
        <br>
        <table class="table" style="text-align: center;">
        <thead>
            <tr>
            <th scope="col">ห้องเช่า</th>
            <th scope="col">รอบชำระ</th>
            <th scope="col">ราคาน้ำ</th>
            <th scope="col">ราคาไฟฟ้า</th>
            <th scope="col">ค่าห้องพัก</th>
            <th scope="col">ราคารวม</th>
            <th scope="col">สถาณะ</th>
            <th scope="col">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td scope="row"><?php echo $row['room_id']; ?></td>
                    <td scope="row"><?php echo date('m/Y', strtotime($row['month_payment'])); ?></td>
                    <td scope="row"><?php echo $row['elect_price']; ?></td>
                    <td scope="row"><?php echo $row['water_price']; ?></td>
                    <td scope="row"><?php echo $row['price_room']; ?></td>
                    <td scope="row"><?php echo $row['total_price']; ?></td>
                    <?php if($row['status_payment'] == '1') { echo '<td scope="row">ชำระแล้ว</td>'; }?>
                    <td scope="row">
                        <a href="billdetail.php?id=<?php echo $row['payment_id']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>