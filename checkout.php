<?php

require_once 'controllers/CheckoutController.php';
$c = new CheckoutController;
return  !isset($_POST['btnCheckout']) ? $c->indexAction(): $c->checkoutAction();

