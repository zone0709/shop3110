<?php
//http://localhost/shop3110/accept-order?token=7zfsA6cHfQg8eS0I4l1WmeboU7i79OAKt1kH20Fl&t=1519735611
//


require_once 'controllers/AcceptOrderController.php';

$c = new AcceptOrderController;
return $c->checkOrder();

?>