<?php
/**
 * Created by PhpStorm.
 * User: rahi.adel
 * Date: 2/24/2018
 * Time: 3:35 PM
 */

class Aboutme
{
    // database connection and table name
    private $conn;

    // aboutme properties
    public $id;
    public $biog;
    public $video_url;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function GetAbout(){

        // select all query
        $query = "SELECT * FROM tbl_aboutme ORDER BY id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}