<?php

require_once 'controllers/HomeController.php';
$c = new HomeController;
if(!$_POST) return $c->searchAction();
return $c->postSearchAction();

