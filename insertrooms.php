
<?php 
    include('layout/head.php');      
    require_once 'db/connect.php';
    if(isset($_POST['insert'])) {
        $room_id = $_POST['room_id'];
        $status = $_POST['status'];
        $alert = $controller->insertroom($room_id, $status);
        if($alert) {
            require_once 'layout/success_alert.php';
        }else{
            require_once 'layout/error_alert.php';
        }
    }
?>
<body>
    <div class="container" >
        <form method="post" action="insertrooms.php">
            <h1>เพิ่มห้องเช่า</h1>
            <br>
            <div class="mb-3">
                <label for="room_id" class="form-label">เลขห้อง</label>
                <input type="text" class="form-control"  name="room_id" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">สถาณะ</label>
                <input type="text" class="form-control" name="status" required>
            </div>
            <button type="submit" name="insert" class="btn btn-primary">เพิ่ม</button>
        </form>
    </div>  
</body>