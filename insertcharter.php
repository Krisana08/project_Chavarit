<?php
     include('layout/head.php'); 
     require_once 'db/connect.php';

     if(isset($_POST['insert'])) {
        $charter_id = $_POST['charter_id'];
        $detail_charter = $_POST['detail_charter'];
        $start_day = $_POST['start_day'];
        $out_day = $_POST['out_day'];
        $rent_id = $_POST['rent_id'];
        $alert = $controller->insertcharter($charter_id, $detail_charter,$start_day,$out_day, $rent_id);
        if($alert) {
            require_once 'layout/success_alert.php';
        }else{
            require_once 'layout/error_alert.php';
        }
        error_reporting(E_ERROR | E_PARSE);
    }
?>
<body>
    <div class="container" >  
        <form method="post" action="insertcharter.php">
            <h1>เพิ่มสัญญาการเช่า</h1>
            <br>
            <div class="mb-3">
                <label for="charter_id" class="form-label">เลขที่สัญญาเช่า</label>
                <input type="text" class="form-control"  name="charter_id">
            </div>
            <div class="mb-3">
                <label for="detail_charter" class="form-label">รายละเอียดสัญญา</label>
                <input type="text" class="form-control"  name="detail_charter">
            </div>
            <div class="mb-3">
                <label for="start_day" class="form-label">วันที่เริ่ม</label>
                <input type="date" class="form-control"  name="start_day">
            </div>
            <div class="mb-3">
                <label for="out_day" class="form-label">วันที่ออก</label>
                <input type="date" class="form-control"  name="out_day">
            </div>
            <div class="mb-3">
                <label for="rent_id" class="form-label">รหัสการเช่า</label>
                <input type="text" class="form-control"  name="rent_id" >
            </div>
            <button type="submit" name="insert" class="btn btn-primary">บันทึก</button>
        </form>
    </div>  
</body>