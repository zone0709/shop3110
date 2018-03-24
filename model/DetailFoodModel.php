<?php
require_once 'DBConnect.php';
class DetailFoodModel extends DBConnect{

    function getFoodById($id, $alias){
        $sql = "SELECT f.*, p.url FROM foods f
                INNER JOIN page_url p
                ON f.id_url = p.id
                WHERE f.id = $id 
                AND p.url = '$alias'";
        return $this->loadOneRow($sql);
    }

    function selectRelatedFood($id_type,$id){
        $sql = "SELECT f.*, p.url FROM foods f
                INNER JOIN page_url p
                ON f.id_url = p.id
                WHERE f.id_type = $id_type
                AND f.id<>$id";

        return $this->loadMoreRows($sql);
    }
    /**
     * ALTER TABLE foods ADD FULLTEXT (name,detail)
     */

    // SELECT * FROM foods 
    // WHERE MATCH(name,detail) AGAINST (50000)
    // OR price = 50000

    function selectFoodById($id){
        $sql = "SELECT * FROM foods WHERE id=$id";
        return $this->loadOneRow($sql);
    }


}
?>