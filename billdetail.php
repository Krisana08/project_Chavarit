<?php
require_once 'layout/head.php';
require_once 'db/connect.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $controller->getbilldetail($id);
}
?>
<div class="container">
    <h1>ประวัติการชำระเงิน</h1>
    <br>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">ห้องพักที่</th>
        <th scope="col">เดือนที่ชำระ</th>
        <th scope="col">ราคาห้องพัก</th>
        <th scope="col">หน่วยน้ำเก่า</th>
        <th scope="col">หน่วยน้ำใหม่</th>
        <th scope="col">ราคาน้ำ</th>
        <th scope="col">หน่วยไฟฟ้าเก่า</th>
        <th scope="col">หน่วยไฟฟ้าใหม่</th>
        <th scope="col">ราคาไฟฟ้า</th>
        <th scope="col">ราคารวม</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td scope="row"><?php echo $result['room_id']; ?></td>
        <td scope="row"><?php echo date('m/Y', strtotime($result['month_payment'])); ?></td>
        <td scope="row"><?php echo $result['price_room']; ?></td>
        <td scope="row"><?php echo $result['water_first']; ?></td>
        <td scope="row"><?php echo $result['water_last']; ?></td>        
        <td scope="row"><?php echo $result['water_price']; ?></td>
        <td scope="row"><?php echo $result['elect_first']; ?></td>
        <td scope="row"><?php echo $result['elect_last']; ?></td>
        <td scope="row"><?php echo $result['elect_price']; ?></td>
        <td scope="row"><?php echo $result['total_price']; ?></td>
        </tr>   
    </tbody>
    </table>

</div>
