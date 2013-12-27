<?php


require_once 'autoload.php';

@session_start();

use OvCart\Storage\SessionStorage;
use OvCart\Cart;
use OvCart\CartManager;

$cart = new Cart('default', 
        new SessionStorage('default',SessionStorage::FILE_HANDLER));
$cartManager = new CartManager('$default', $cart);


