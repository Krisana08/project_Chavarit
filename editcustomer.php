<?php
    require_once 'db/connect.php';
    require_once 'layout/head.php';
    if(!isset($_GET['id'])) {
        header("Location: customers.php");
    }else{
        $id = $_GET['id'];
        $emp = $controller->getcustomerdetail($id);
        
    }
?>

<div class="container" >  
        <form method="post" action="updatecustomer.php">
            <h1>แก้ไขข้อมูลผู้เช่า</h1>
            <br>
            <input type="hidden" name="customer_cardid" value="<?php echo $emp['customer_cardid']; ?>">
            <div class="mb-3">
                <label for="customer_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control"  name="customer_name" value="<?php echo $emp['customer_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="customer_lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="customer_lastname" value="<?php echo $emp['customer_lastname']; ?>" required>
            </div>
            <button type="submit" name="edit" class="btn btn-primary">เปลี่ยนแปลงข้อมูล</button>
        </form>
    </div>  