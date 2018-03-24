<?php
require_once 'DBConnect.php';
class HomeModel extends DBConnect{

    function getTodayFoods(){
        $sql = "SELECT f.*, p.url FROM foods f
                INNER JOIN page_url p
                ON f.id_url = p.id
                WHERE f.today=1";
        return $this->loadMoreRows($sql);
    }

    function getAllFoods($vitri = 0, $soluong = 0){
        $sql = "SELECT f.*, p.url FROM foods f
                INNER JOIN page_url p
                ON f.id_url = p.id ";
        if($vitri >= 0 && $soluong>0){
            $sql .=" LIMIT $vitri,$soluong";
        }
        return $this->loadMoreRows($sql);
    }

    function countFoods(){
        $sql = "SELECT count(id) FROM foods";
        return $this->loadOneRow($sql);
    }

    function selectPromotionFoods(){
        $sql = "SELECT f.*, p.url FROM foods f
                INNER JOIN page_url p
                ON f.id_url = p.id
                WHERE promotion_price<price
                AND promotion_price<>0
                ORDER BY f.id DESC 
                LIMIT 0,16";
        return $this->loadMoreRows($sql);
    }

    // function searchFoods($key,$vitri,$soluong=2){
    //     $sql = "SELECT f.*,p.url FROM foods  f
    //             INNER JOIN page_url p
    //             ON f.id_url = p.id
    //             WHERE MATCH(name,detail) AGAINST('$key')
    //             OR price='$key'
    //             LIMIT $vitri,$soluong";
    //     return $this->loadMoreRows($sql);
        
    // }
    function searchFoods($key){
        $sql = "SELECT f.*,p.url FROM foods  f
                INNER JOIN page_url p
                ON f.id_url = p.id
                WHERE MATCH(name,detail) AGAINST('$key')
                OR price='$key'";
        return $this->loadMoreRows($sql);
        
    }
}


?>