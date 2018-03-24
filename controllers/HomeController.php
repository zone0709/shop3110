<?php
require_once 'Controller.php';
require_once 'model/HomeModel.php';
require_once 'helpers/Pager.php';

class HomeController extends Controller{

    function indexAction(){
        // echo "<pre>";
        // print_r($_SERVER);
        
        // echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        // die;
        $title = "Home Page";

        $model = new HomeModel;
        $foods = $model->getTodayFoods();

        $allFoods = $model->getAllFoods();
        $tongSP = count($allFoods); //tinh so link phan trang
        /*
             $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']!=0
               ? (int)abs($_GET['page']) : 1;
        */
        $page = 1;
        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']!=0){
            $page = (int)abs($_GET['page']);
        }
        $soluong = 9;
        $vitri = ($page - 1)*$soluong;
        $allFoods = $model->getAllFoods($vitri, $soluong);

        $pager = new Pager($tongSP,$page,$soluong,5);
        $paginationHTML = $pager->showPagination();

        $value = [
            'title' => $title,
            'foods' => $foods,
            'allFoods' => $allFoods,
            'paginationHTML' => $paginationHTML
        ];
        return $this->loadView('index',$value);
    }

    function searchAction(){
        $model = new HomeModel;
        $promotionFoods = $model->selectPromotionFoods();

        $data = [
            'title'=>"Tìm kiếm",
            'promotionFoods'=>$promotionFoods
        ];
        return $this->loadView('search', $data);
    }

    // function postSearchAction(){
    //     $key = $_POST['tukhoa'];
    //     $model = new HomeModel;
    //     $soluong = 2;
    //     $page = isset($_POST['clickTime']) ?$_POST['clickTime'] : 1 ;
    //     $vitri = ($page - 1)*$soluong;
    //     $foods = $model->searchFoods($key,$vitri);
    //     return $this->callView("result-search",$foods);
    // }
    function postSearchAction(){
        $key = $_POST['tukhoa'];
        $model = new HomeModel;
        $foods = $model->searchFoods($key);
        return $this->callView("result-search",$foods);
    }

}


