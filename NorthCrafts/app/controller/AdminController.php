<?php

class AdminController {
    public function index() {

        $view = new View();
        $view->render('admin');
    }
    /*public function __construct() {
        if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != 'MightyHamster' || $_SERVER['PHP_AUTH_PW'] != 'MightyHamster123456') {
          header('WWW-Authenticate: Basic realm="Restricted area"');
          header('HTTP/1.0 401 Unauthorized');
          die('Access Denied');
        }
      }*/
    public function signin() {
        $password = $_POST['password'];

        $adminPassword = Admin::getAdmin($password);

        if(isset($_POST['signInButton'])) {

            if(empty($password)) {
                header("Location:.. ");

            }
            else {
                //$adminPassword = Admin::getAdmin($password);
                $pwdcheck = password_verify($password, "$2y$10$5WOd6kXA1AfDNpY.cLaHEuME9bh.QtwtI8SAnuThdffBcSeY32uUG");
                   
                if($pwdcheck === true) {
                    Session::start();
                    Session::set('admin', 'Filip');
                    $session = Session::get('admin');
                    echo $session;

                    header('Location: /upload');

                }
                else {
                    echo 'User does not exist';
                }
            }
        }
    }

    public function signout() {
        if(isset($_POST['signOutButton'])) {
            Session::stop();
            header("Location:..");
        }
    }
}