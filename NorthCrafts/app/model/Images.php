<?php

class Images {
    private $id;
    private $imgName;
    private $pubName;
    private $price;
    private $description;

    public function __construct($id, $imgName, $price, $description) {
        $this->id = $id;
        $this->imgName = $imgName;
        $this->price = $price;
        $this->description = $description;
      }

    public static function insertImg($imgName, $pubName, $price, $description) {
        $db = Db::getInstance()->prepare('INSERT INTO images (imgName, pubName, price, description) VALUES (?, ?, ?, ?)');
        $db->execute([$imgName, $pubName, $price, $description]);
    }

    public static function getAllImgs() {
        $db = Db::getInstance()->prepare('SELECT * FROM images');
        $db->execute();

        return $row = $db->fetchAll();
    }

    public static function getImg($id) {
        $db = Db::getInstance()->prepare('SELECT * FROM images WHERE id=?');
        $db->execute([$id]);

        return $row = $db->fetchAll();
    }

    public static function countAllImages() {
        $db = Db::getInstance()->prepare("SELECT COUNT(imgName) FROM images");
        $db->execute();

        return $row = $db->fetch();
    }
}