<?php
class DBConnect{

    private $db = NULL;
    private $statement = NULL;

    function __construct(){
        //ket noi db
        $this->db = new PDO('mysql:host=localhost;dbname=php3110_banhang', 'root', '');
        $this->db->exec("SET NAMES UTF8");
    }

    //thuc thi query
    // UPDATE/INSERT/DELETE

    
    //update customer set email = ? where email = ?
    //$values = [$name,$id];

    function bindParam($sql, $values = array()){
        if(strlen($sql) <=0) return false;
        $quantity = count($values); 
        $stmt = $this->db->prepare($sql);
        if(stripos($sql, '?') && !empty($values) && substr_count($sql,'?') == $quantity){
            for($i=1; $i<=$quantity; $i++){
                $stmt->bindParam($i,$values[$i-1]);
            }
        }
        elseif(stripos($sql, '?') && empty($values) || substr_count($sql,'?') != $quantity)
            return false;
        return $this->statement = $stmt;

    }

    //INSERT/UPDATE/DELETE
    function executeQuery($sql, $values = array()){
        $stmt = $this->bindParam($sql,$values);
        if(!$stmt) return false;
        return $stmt->execute();
    }

    //SELECT 1 row
    function  loadOneRow($sql, $values = array()){
        $stmt = $this->bindParam($sql,$values);
        if(!$stmt) return false;
        $check = $stmt->execute();
        if(!$check)return false;
        return $stmt->fetch(PDO::FETCH_OBJ);   
    }

    function loadMoreRows($sql, $values = array()){
        $stmt = $this->bindParam($sql,$values);
        if(!$stmt) return false;
        $check = $stmt->execute();
        if(!$check)return false;
        return $stmt->fetchAll(PDO::FETCH_OBJ);  
    }

    function getLastId(){
        //lastInsertId()
        return $this->db->lastInsertId();
    }

    function rowCount(){
        //rowCount()
        $stmt = $this->statement;
        return $stmt->rowCount();
    }
}

//TH1
// $sql = "update customer set name = ?"; //Ti //14
// $db = new DBConnect;

// $values = ['Thuong Thuong'];
// $result = $db->executeQuery($sql, $values);
// if($result){
//     echo $result = $db->rowCount();
// }
// else echo 121;
// die;

// //TH2
// $sql = "update customer set name = 'teo' where id = 13"; //Ti //14
// $db = new DBConnect;

// //$values = ['Ti', 14];
// $result = $db->executeQuery($sql);
// var_dump($result);

// $sql = "INSERT INTO slide(link,image) VALUES (?,?)";
// $db = new DBConnect;
// $values = ["hinh2.png"];
// $result = $db->executeQuery($sql,$values);
// var_dump($result);


// $sql = "INSERT INTO slide(link,image) VALUES ('https://khoapham.vn','hinh334.png')";
// $db = new DBConnect;
// $result = $db->executeQuery($sql);
// var_dump($result);


// $sql = "SELECT * FROM slide ";
// $db = new DBConnect;
// //$result = $db->loadOneRow($sql);
// $result = $db->loadMoreRows($sql);
//  print_r($result);
?>
