<?php
require_once 'DBConnect.php';
class CheckoutModel extends DBConnect{

    function insertCustomer($name,$email,$address,$phone){
        $sql = "INSERT INTO customers(name,email,address,phone)
                VALUES('$name','$email','$address','$phone')";
        return $this->executeQuery($sql) ? $this->getLastId() : false; 
    }

    function insertBill($id_customer,$dateOrder,$total,$paymentMethod,$note,$token,$tokenDate){
        $sql = "INSERT INTO bills(id_customer,date_order,total,payment_method,note,token,token_date)
                VALUES($id_customer,'$dateOrder',$total,'$paymentMethod','$note','$token','$tokenDate')";
    
    return $this->executeQuery($sql) ? $this->getLastId() : false; 
    }

    function insertBillDetail($idBill,$idFood,$qty,$price){
        $sql = "INSERT INTO bill_detail(id_bill,id_food,quantity,price) 
                VALUES($idBill,$idFood,$qty,$price)";
        return $this->executeQuery($sql);
    }

    function deleteRecentCus($id){
        $sql = "DELETE FROM customers WHERE id=$id";
        return $this->executeQuery($sql);
    }

    function deleteRecentBill($id){
        $sql = "DELETE FROM bills WHERE id=$id";
        return $this->executeQuery($sql);
    }

    function deleteRecentBillDetail($idBill){
        $sql = "DELETE FROM bill_detail WHERE id_bill=$idBill";
        return $this->executeQuery($sql);
    }

}