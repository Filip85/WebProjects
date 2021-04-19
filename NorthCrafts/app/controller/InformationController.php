<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'C:\xampp\htdocs\NorthCrafts\vendor\autoload.php';

class InformationController {

    public function index() {

        if(!isset($_SESSION['shopping_cart'])) {
            header('Location: ..');
        }

        $view = new View();
        $view->render('information');
    }

    public function sendEmail() {
        //echo !extension_loaded('openssl')?"Not Available":"Available";
        $table = '<table style="margin: 10px">
        <tr style="margin: 30px">
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>';
        $products = Session::get('shopping_cart');
        if(!empty($_SESSION['shopping_cart'])) {
            foreach($products as $product) {
                $table .= 
                '<tr>
                    <td style="margin: 300px">'.$product['pubName'].'</td>
                    <td>'.$product['price'].'Kn</td>
                    <td>'.$product['quantity'].'</td>
                </tr>';
            }
        }

        $table .= "</table>";
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //$mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->isHTML();
        $mail->Username = "filipgajari80@gmail.com";
        $mail->Password = "hpl1908w2";
        $mail->setFrom('filipgajari80@gmail.com');
        $mail->Subject = "North Crafts";
        $mail->Body = $table;
        $mail->AddAddress("filipgajari80@gmail.com");

        $mail->Send();

        header( "refresh:5;url=../index" );

    }
}