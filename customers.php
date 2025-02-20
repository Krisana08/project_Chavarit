<?php
    require_once 'layout/head.php';
    require_once 'db/controller.php';
    require_once 'db/connect.php';
    $result = $controller->watch_customer();
?>
<body>
    <div class="container" >  
        <h1>การจัดการสมาชิก</h1>
        <br>
        <div>
        <a href="insertcustomer.php"><button type="button" class="btn btn-outline-primary" >เพิ่มสมาชิก</button></a>
        </div>
        <br>
        <table class="table table-dark table-sm" style="text-align: center;">
        <thead>
            <tr>
            <th scope="col">ชื่อผู้เช่า</th>
            <th scope="col">นามสกุลผุ้เช่า</th>
            <th scope="col">รหัสบัตรประชาชน</th>
            <th scope="col">การจัดการผู้เช่า</th>

            </tr>
        </thead>
        <tbody>
            <?php while($row=$result->fetch(PDO::FETCH_ASSOC)){?>
                <tr>
                    <td scope="row"><?php echo $row['customer_name']; ?></td>
                    <td scope="row"><?php echo $row['customer_lastname']; ?></td>
                    <td scope="row"><?php echo $row['customer_cardid']; ?></td>
                    <td scope="row" >
                        <a href="editcustomer.php?id=<?php echo $row['customer_cardid']; ?>"><button type="button" class="btn btn-outline-warning">แก้ไข</button></a>
                    </td>
                    
                </tr>
            <?php }?>
            
        </tbody>
    </table>
</body>