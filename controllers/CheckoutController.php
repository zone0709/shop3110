<?php
require_once 'Controller.php';
require_once 'helpers/Cart.php';
require_once 'model/CheckoutModel.php';
require_once 'helpers/functions.php';
require_once 'helpers/mailer/mailer.php';
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

class CheckoutController extends Controller{
    function __construct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }
    function indexAction(){
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;

        $data = [
            'title'=>'Giỏ hàng của bạn',
            'cart'=>$cart
        ];
        return $this->loadView('checkout',$data);
    }

    function checkoutAction(){
        //POST
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $note = $_POST['note'];

        $model = new  CheckoutModel;
        $idCustomer = $model->insertCustomer($fullname,$email,$address,$phone);
        if($idCustomer>0){
            //save bill
            $dateOrder = date('Y-m-d',time());
            $paymentMethod = "tructiep";
            $token = createToken();
            $tokenDate = time();

            $oldCart = $_SESSION['cart'];
            $cart = new Cart($oldCart);
            $total = $cart->totalPrice; 

            $idBill = $model->insertBill($idCustomer,$dateOrder,$total,$paymentMethod,$note,$token,$tokenDate);
            if($idBill){
                //save bill detail
                foreach($cart->items as $idSP=>$sp){
                    // echo "<pre>";
                    // print_r($sp); die;
                    $billDetail = $model->insertBillDetail($idBill,$idSP,$sp['qty'],$sp['price']);
                    if(!$billDetail){
                        //xoa bill
                        $model->deleteRecentBill($idBill);
                        //xoa cus
                        $model->deleteRecentCus($idCustomer);
                        //xoa bill detail
                        $model->deleteRecentBillDetail($idBill);

                        $_SESSION['error']="Vui lòng thử lại 1";
                        header('Location:gio-hang.html');
                        return;
                    }
                    //thanh cong?
                    //gui mail
                    //https://github.com/huongnguyen08/php-mailer
                    $link = "http://localhost/shop3110/accept-order?token=$token&t=$tokenDate";

                    $subject = "Xác nhận đơn hàng  #DH00-$idBill";
                    $content = "<h3>nội dung mail</h3>
                        Vui lòng click vào liên kết bên dưới để xác nhận đơn hàng
                        <br/>
                        $link,
                        <br/>
                        Thanks.
                    ";
                    sendMail($fullname, $email, $subject, $content);

                    //////////////tao link check token mail////////////////////////


                    unset($_SESSION['cart']);
                    unset($cart);

                    $_SESSION['success']= "Kiểm tra email để xác nhận đơn hàng";
                    header('Location:gio-hang.html');
                    return;
                    

                }
            }
            else{
                //delete Customer 
                $model->deleteRecentCus($idCustomer);
                $_SESSION['error']="Vui lòng thử lại 2";
                header('Location:gio-hang.html');
                return;
            }
        }
        else{
            $_SESSION['error']="Vui lòng thử lại";
            header('Location:gio-hang.html');
            return;
        }

        
    }
}

