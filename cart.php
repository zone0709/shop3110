<?php
require_once 'controllers/CartController.php';
$c= new CartController;
if($_GET['action'] == 'add'){
    return $c->addToCart();
}
elseif($_GET['action'] == 'update'){
    return $c->updateCart();
}
elseif($_GET['action']=='delete')
    return $c->deleteCart();

//return $_GET['action'] == 'add' ? $c->addToCart() : $_GET['action']=='delete ? $c->deleteCart() : $c->updateCart();

?>