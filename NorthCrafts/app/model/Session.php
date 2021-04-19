<?php

$product_ids = array();

class Session {
    private static $sessionStarted = false;

    public static function start() {
        if(self::$sessionStarted == false) {
            self::$sessionStarted = true;
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function setSessionArray($key, $imgId, $pubName, $imgPrice, $quantity) {
        if(isset($_SESSION['shopping_cart'])) {
            $count = count($_SESSION['shopping_cart']);
            $product_ids = array_column($_SESSION['shopping_cart'], 'id');

            $_SESSION[$key][$count] = array(
                'id' =>$imgId, 
                'pubName' => $pubName, 
                'price' => $imgPrice,
                'quantity' => $quantity);
        }
        else {
            $_SESSION[$key][0] = array(
                'id' =>$imgId, 
                'pubName' => $pubName, 
                'price' => $imgPrice,
                'quantity' => $quantity);
        }
    }

    public static function get($key){
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        else {
            return false;
        }
    }

    public static function delete($id) {
        $products = Session::get('shopping_cart');

        foreach($products as $key => $product) {
            if($product['id'] === $id) {
                unset($_SESSION['shopping_cart'][$key]);
                header('Location: ..');
            }
        }
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }

    public static function stop() {
        if(self::$sessionStarted == true) {
            self::$sessionStarted = false;
            session_destroy();
            unset($_SESSION['admin']);
        }
    }
}