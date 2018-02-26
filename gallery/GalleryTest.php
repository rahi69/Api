<?php
/**
 * Created by PhpStorm.
 * User: rahi.adel
 * Date: 2/25/2018
 * Time: 4:30 PM
 */

class GalleryTest
{
    // database connection and table name
    private $conn;

    // aboutme properties
    public $id_gallery;
    public $title;
    public $type;
    public $video_url;
    public $prev_url;
    public $image_url;
    public $date;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // search products
    function search($keywords){
//        $query = query("SELECT * FROM list_news WHERE news_name LIKE '%{$news_name}%' AND news_description LIKE '%{$news_description}%' AND news_short_des LIKE '%{$news_short_desc}%'");

        // select all query
        $query ="SELECT * FROM tblgallery WHERE `type` LIKE ? ORDER BY id_gallery DESC";
//        $query = "SELECT
//                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
//            FROM
//                " . $this->table_name . " p
//                LEFT JOIN
//                    categories c
//                        ON p.category_id = c.id
//            WHERE
//                p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
//            ORDER BY
//                p.created DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
//        $stmt->bindParam(2, $keywords);
//        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}