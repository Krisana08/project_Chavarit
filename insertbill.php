<?php
include('layout/head.php');
require_once 'db/connect.php';
setlocale(LC_TIME, 'th_TH.UTF-8');

$id = $_GET['id']; // ดึงค่า id ของห้องพักจาก URL

// สร้างออบเจ็กต์ของคลาส Controller
$controller = new Controller($pdo);

// ดึงข้อมูลค่าเช่าจากตาราง payment_detail
$paymentDetail = $controller->getpaymentdetail($id);

if (isset($_POST['insert'])) {
    $room_id = $_POST['room_id'];
    $month = $_POST['month'];
    $elect_first = $_POST['elect_first'];
    $elect_last = $_POST['elect_last'];
    $water_first = $_POST['water_first'];
    $water_last = $_POST['water_last'];
    $water_price = $_POST['water_price'];
    $elect_price = $_POST['elect_price'];
    $total_price = $_POST['total_price'];
    $status_payment = $_POST['status_payment'];    
    $alert = $controller->insertbill($room_id ,$month,$elect_first,$elect_last,$water_first,$water_last,$water_price ,$elect_price,$total_price,$status_payment);
    if ($alert) {
        require_once 'layout/success_alert.php';
    } else {
        require_once 'layout/error_alert.php';
    }
    error_reporting(E_ERROR | E_PARSE);
}
?>

<body>
    <div class="container">
        <h2>เพิ่มค่าเช่า</h2>
        <br>
        <br>
        <form class="row gx-3 gy-2 align-items-center" method="post" action="">
            <div class="col-sm-3">
                <label for="room_id" class="form-label">ห้องพักที่</label>
                <input type="text" readonly class="form-control" name="room_id" value="<?php echo $id; ?>">
            </div>
            <div class="col-sm-3">
                <label for="month" class="form-label">รอบบิล</label>
                <input type="date" class="form-control" name="month" required>
            </div>
            <div class="col-sm-3">
                <label for="price" class="form-label">ค่าเช่า</label>
                <input type="text" readonly class="form-control" name="price" id="price" value="<?php echo $paymentDetail['price_room']; ?>">
            </div>
            <div class="col-sm-4">
                <label for="water_first" class="form-label">หน่วยน้ำเก่า</label>
                <input type="text" readonly class="form-control" name="water_first" id="water_last" value="<?php echo $paymentDetail['water_last']; ?>">
            </div>
            <div class="col-sm-4">
                <label for="water_last" class="form-label">หน่วยน้ำใหม่</label>
                <input type="text" class="form-control" name="water_last" id="water_new" required oninput="calculateWaterPrice()">
            </div>
            <div class="col-sm-4">
                <label for="water_price" class="form-label">รวมราคาน้ำ</label>
                <input type="text" readonly class="form-control" name="water_price" id="water_price">
            </div>
            <div class="col-sm-4">
                <label for="elect_first" class="form-label">หน่วยไฟฟ้าเก่า</label>
                <input type="text" readonly class="form-control" name="elect_first" id="elect_last" value="<?php echo $paymentDetail['elect_last']; ?>">
            </div>
            <div class="col-sm-4">
                <label for="elect_last" class="form-label">หน่วยไฟฟ้าใหม่</label>
                <input type="text" class="form-control" name="elect_last" id="elect_new" required oninput="calculateElectPrice()">
            </div>
            <div class="col-sm-4">
                <label for="elect_price" class="form-label">รวมราคาไฟ</label>
                <input type="text" readonly class="form-control" name="elect_price" id="elect_price">
            </div>
            <div class="col-sm-4">
                <label for="total_price" class="form-label">รวมราคา</label>
                <input type="text" readonly class="form-control" name="total_price" id="total_price">
            </div>
            <div class="col-sm-4">
                <label for="status_payment" class="form-label">วิธีการชำระเงิน</label>
                <select class="form-control" name="status_payment" id="status_payment" required>
                    <option value="0">ค้างจ่าย</option>
                    <option value="1">ชำระแล้ว</option>
                </select>
            </div>
            <div class="col-sm-3">
                <button type="submit" name="insert" class="btn btn-primary">เพิ่มค่าเช่า</button>
            </div>
        </form>
    </div>

    <script>
        function calculateWaterPrice() {
            const waterLast = parseFloat(document.getElementById('water_last').value) || 0;
            const waterNew = parseFloat(document.getElementById('water_new').value) || 0;
            const waterPrice = (waterNew - waterLast) * 20;
            document.getElementById('water_price').value = waterPrice.toFixed(2);
            calculateTotalPrice();
        }

        function calculateElectPrice() {
            const electLast = parseFloat(document.getElementById('elect_last').value) || 0;
            const electNew = parseFloat(document.getElementById('elect_new').value) || 0;
            const electPrice = (electNew - electLast) * 30;
            document.getElementById('elect_price').value = electPrice.toFixed(2);
            calculateTotalPrice();
        }

        function calculateTotalPrice() {
            const room_price = parseFloat(document.getElementById('price').value) || 0;
            const waterPrice = parseFloat(document.getElementById('water_price').value) || 0;
            const electPrice = parseFloat(document.getElementById('elect_price').value) || 0;
            const totalPrice = room_price + waterPrice + electPrice;
            document.getElementById('total_price').value = totalPrice.toFixed(2);
        }
    </script>
</body>