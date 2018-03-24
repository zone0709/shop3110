<?php
require_once 'model/AcceptOrderModel.php';
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

class AcceptOrderController {
    function checkOrder(){
        $token = $_GET['token'];
        $time = $_GET['t'];

        $model = new AcceptOrderModel;
        $bill = $model->selectBillByToken($token);
        
        if($bill){
            $timeCheck = strtotime('+1 day', $bill->token_date) ;
            // echo '<br>';
            // echo time();
            // echo date('d/m/Y H:i:s',$timeCheck);
            if(time() > $timeCheck){
                $_SESSION['error'] = "Thời gian xác nhận đơn hàng đã hết hạn, vui lòng đặt hàng lại";
                header('Location:404');
            }
            else{
                $model->updateStatusBill($bill->id);
                $_SESSION['success'] = "Xác nhận đơn hàng thành công, Cảm ơn bạn....";
                header('Location:http://localhost/shop3110/gio-hang.html');
            }
        }
        else{
            $_SESSION['error'] = "Liên kết bạn nhập vào không tồn tại";
            header('Location:404');
        }
    }
}


?>