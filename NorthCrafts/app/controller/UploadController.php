<?php 

class UploadController {
    public function index() {
        Session::start();
        $session = Session::get('admin');

        if(isset($_SESSION['admin'])) {
            
            $view = new View();
            $view->render('upload', [
                'session' => $session,
            ]);
        }
        else {
            echo 'Please, sign in!';
        }
    }

    public function uploadImage() {
        var_dump(1);

        if(isset($_POST['uploadImage'])) {
            $pubName = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['taname'];
            $file = $_FILES['file'];

            var_dump($file);

            $_fileName = $_FILES['file']['name'];
            $_fileError = $_FILES['file']['error'];
            $_fileTmpName = $_FILES['file']['tmp_name'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $_fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)) {
                if($_fileError > 0) {
                    echo 'There was an error uploading your file!';
                }
                else {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    var_dump($fileNameNew);
                    $fileDestination = BP. 'public/img/'.$fileNameNew;

                    move_uploaded_file($_fileTmpName, $fileDestination);
                    
                    Images::insertImg($fileNameNew, $pubName, $price, $description);
                }
            } 
        }
    } 
}