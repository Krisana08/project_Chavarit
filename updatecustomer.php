<?php
require_once 'db/connect.php';
    if(isset($_POST['edit'])) {
        $customer_id = $_POST['customer_id'];
        $customer_name = $_POST['customer_name'];
        $customer_lastname = $_POST['customer_lastname'];
        $customer_cardid = $_POST['customer_cardid'];

        $result = $controller->updatecustomer( $customer_cardid, $customer_name, $customer_lastname);
        if($result){
            header("Location: customers.php");
            
        }
    }
?>