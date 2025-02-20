
<?php 
    include('layout/head.php');      
    require_once 'db/connect.php';
    if(isset($_POST['insert'])) {

        $customer_name = $_POST['customer_name'];
        $customer_lastname = $_POST['customer_lastname'];
        $customer_cardid = $_POST['customer_cardid'];
        $status = $controller->insert($customer_name, $customer_lastname, $customer_cardid);
        if($status) {
            require_once 'layout/success_alert.php';
        }else{
            require_once 'layout/error_alert.php';
        }
    }
?>
<body>
    <div class="container" >  
        <form method="post" action="insertcustomer.php">
            <h1>ลงทะเบียนผู้เช่า</h1>
            <br>
            <div class="mb-3">
                <label for="customer_name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control"  name="customer_name" required>
            </div>
            <div class="mb-3">
                <label for="customer_lastname" class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="customer_lastname" required>
            </div>
            <div class="mb-3">
                <label for="customer_cardid" class="form-label">รหัสบัตรประชาชน</label>
                <input type="text" class="form-control" name="customer_cardid" required>
            </div>
            <button type="submit" name="insert" class="btn btn-primary">เพิ่ม</button>
        </form>
    </div>  
</body>