<?php
    require_once 'db/connect.php';
    require_once 'layout/head.php';
    if(!isset($_GET['id'])) {
        header("Location: bill.php");
    }else{
        $id = $_GET['id'];
        $emp = $controller->getpaymentdetail($id);
        
    }
?>

<div class="container" >  
        <form method="post" action="updatepayment_detail.php">
            <h1>แก้ไขข้อมูลค่าเช่า</h1>
            <br>
            <input type="hidden" name="paymentd_id" value="<?php echo $emp['paymentd_id']; ?>">
            <div class="mb-3">
                <label for="price_rent" class="form-label">ค่าเช่า</label>
                <input type="text" class="form-control"  name="price_rent" value="<?php echo $emp['price_rent']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="water_price" class="form-label">ค่าน้ำ</label>
                <input type="text" class="form-control"  name="water_price" value="<?php echo $emp['water_price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="elect_price" class="form-label">ค่าไฟ</label>
                <input type="text" class="form-control" name="elect_price" value="<?php echo $emp['elect_price']; ?>" required>
            </div>
            <button onclick="return confirm('ต้องการเปลี่ยนแปลงข้อมูลหรือไม่ ?')" type="submit" name="edit" class="btn btn-primary">เปลี่ยนแปลงข้อมูล</button>
        </form>
    </div>  