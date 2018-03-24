<?php
require_once 'Controller.php';
require_once "model/DetailFoodModel.php";

class DetailFoodController extends Controller{
    
    //detail-food.php?id=1&alias=banh-canh
    function indexAction(){
        $model = new DetailFoodModel;

        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : false;
        $alias = isset($_GET['id']) ? $_GET['alias'] : false;

        $food = $model->getFoodById($id, $alias);
        if(!$food || $id==false || $alias==false){
            header("Location:404.php");
            return;
        }
        $relatedFoods = $model->selectRelatedFood($food->id_type,$food->id);
        //print_r($relatedFoods);
        $data = [
            'title'=> $food->name,
            'food'=>$food,
            'relatedFoods'=>$relatedFoods
        ];
        return $this->loadView('detail-food',$data);
    }

}


