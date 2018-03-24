<?php

class Controller{

    function loadView($view, $data = []){
        require_once('views/layout.php');
    }

    function callView($view,$data=[]){
        require_once("views/$view.php");
    }
}



?>