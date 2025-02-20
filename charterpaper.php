<?php
    require_once 'db/connect.php';
    require_once 'layout/head.php';
    if(!isset($_GET['charter_id'])) {
        header("Location: charter.php");
    }else{
        $id = $_GET['charter_id'];
        $got = $controller->getcharterdetail($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br>
    <img src="image/logo.jpg" alt="โลโก้" width="100" height="100" style="justify-content: center; display: block; margin-left: auto; margin-right: auto;">
    <br>
    
    <div class="container">
        <h1 style="text-align: center;">เอกสารสัญญาเช่า</h1>
        <br>
    <div style="font-size: 20px; margin-bottom: 100px;">
        หนังสือสัญญาที่  <?php echo $got['charter_id']; ?> <br><br>
        โดยมีรายละเอียดการเช่าดังนี้ <?php echo $got['detail_charter'];?> <br><br>
        ได้ทำการเช่าในห้องที่ <?php echo $got['rent_id']; ?><br><br>
        ที่เริ่มการเช่า <?php $start_day = strtotime($got['start_day']);
        echo date('d/m/', $start_day) . (date('Y', $start_day) + 543);?><br><br>
        วันที่สิ้นสุดการเช่า <?php $out_day = strtotime($got['out_day']);
        echo date('d/m/', $out_day) . (date('Y', $out_day) + 543);?><br><br>
        ได้ทำการชำระเงินจำนวน 
       
    </div>
    <h5 >ลงชื่อผู้เช่า</h5>
    <br>
    _____________________________
    
    
</body>
</html>