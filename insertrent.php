<?php
     include('layout/head.php'); 
     require_once 'db/connect.php';

     if(isset($_POST['insert'])) {
        $rent_id = $_POST['rent_id'];
        $room_id = $_POST['room_id'];
        $customer_cardid = $_POST['customer_cardid'];
        $customer_name = $_POST['customer_name'];
        $customer_lastname = $_POST['customer_lastname'];
        $day = $_POST['day'];
        $alert = $controller->insertrentdetail($rent_id, $customer_cardid,$customer_name,$customer_lastname, $room_id,$day);
        if($alert) {
            require_once 'layout/success_alert.php';
        }else{
            require_once 'layout/error_alert.php';
        }
        error_reporting(E_ERROR | E_PARSE);
        if($alert) {
            $controller->change($room_id);
        }
    }
?>
<body>
    <div class="container" >  
        <form method="post" action="insertrent.php">
            <h1>ลงทะเบียนการเช่าห้องพัก</h1>
            <br>
            <div class="mb-3">
                <label for="rent_id" class="form-label">เลขที่การเช่า</label>
                <input type="text" class="form-control"  name="rent_id">
            </div>
            <div class="mb-3">
                <label for="customer_cardid" class="form-label">บัตรประชาชนผู้เช่า</label>
                <input type="text" class="form-control"  name="customer_cardid">
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">ชื่อผู้เช่า</label>
                <input type="text" class="form-control"  name="customer_name">
            </div>
            <div class="mb-3">
                <label for="customer_lastname" class="form-label">นามสกุลผู้เช่า</label>
                <input type="text" class="form-control"  name="customer_lastname">
            </div>
            <div class="mb-3">
                <label for="room_id" class="form-label">ห้องพักที่</label>
                <input type="text" class="form-control"  name="room_id" value="<?php $id=$_GET['id']; echo $id;?>">
            </div>
            <div class="mb-3">
                <label for="day" class="form-label">วันที่เริ่มเช่า</label>
                <input type="date" name="day">
            </div>
            <button type="submit" name="insert" class="btn btn-primary">บันทึก</button>
        </form>
    </div>  
</body>