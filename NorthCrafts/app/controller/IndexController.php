<?php


class IndexController {
    public function index() {

        $images = Images::getAllImgs();

        $view = new View();
        $view->render('index', [
        'images' => $images
        ]);
    }

    public function addToChart() {
        $imgName = $_POST['imgName'];
        $price = $_POST['price'];
        $imgId = $_POST['id'];
        $quantity = $_POST['quantity'];
        var_dump($imgName);

        /*if(isset($_POST['addToChart'])) {*/
            Session::setSessionArray('shopping_cart', $imgId, $imgName, $price, $quantity);
            IndexController::pre_r($_SESSION);
        //}

        //var_dump("ddsdsds");

        //header('Location: ..');
    }

    public function removeFromChart() {
        $id = $_POST['id'];
        var_dump($id);
        header('Location: ..');

        if(isset($_POST['removeFromChart'])) {
            Session::delete($id);
            header('Location: ..');
        }
    }

    public function nextStep() {

        if(isset($_POST['nextStepButton'])) {
            header('Location: /information');
        }
    }

    public function pre_r($array) {
        echo '<pre>';
        print_r($array);
        echo '<pre>';
    }

    public function count() {
        $img = Images::countAllImages();

        var_dump($img);

        echo 'Number of images: '.$img['COUNT(imageName)'];
    }
}