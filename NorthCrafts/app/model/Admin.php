<?php

class Admin {
    private $id;
    private $firstName;
    private $lastName;
    private $password;

    public static function getAdmin($password) {
        $db = Db::getInstance()->prepare("SELECT pwdAdmin FROM admin WHERE pwdAdmin=?");
        $db->execute([$password]);

        $row = $db->fetchAll();
        //var_dump($row);

        //return $row;

        foreach ($row as $r) {
            echo $r['pwdAdmin'];
            break;
        }
    }
}