<?php
require_once 'DBConnect.php';
class AcceptOrderModel extends DBConnect{

    function selectBillByToken($token){
        $sql = "SELECT * FROM bills WHERE token = '$token'";
        return $this->loadOneRow($sql);
    }

    function updateStatusBill($id){
        $sql = "UPDATE bills SET token ='', token_date='', status=1 WHERE id=$id";
        return $this->executeQuery($sql);
    }

}
?>