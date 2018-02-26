<?php
/**
 * Created by PhpStorm.
 * User: rahi.adel
 * Date: 2/24/2018
 * Time: 12:34 PM
 */

class Article
{
    // database connection and table name
    private $conn;

    // aboutme properties
    public $id_article;
    public $title;
    public $description;
    public $short_desc;
    public $image_src;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){

        // select all query
        $query = "SELECT * FROM tbl_article ORDER BY id_article DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // used when filling up the update product form
    function readOne(){
//        $id = $_POST['id_article'];
        // query to read single record
//        $query = "SELECT * FROM tbl_article WHERE id_article = '{$id}'";
        $query = "SELECT * FROM tbl_article WHERE id_article = ? ";


        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_article);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to aboutme properties
        $this->title = $row['title'];
        $this->short_desc = $row['short_desc'];
        $this->description = $row['description'];
        $this->image_src = $row['image_src'];
    }
}