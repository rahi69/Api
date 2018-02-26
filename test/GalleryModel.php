<?php
/**
 * Created by PhpStorm.
 * User: Ms
 * Date: 14/02/2018
 * Time: 04:16 PM
 */

class GalleryModel
{
    private $conn;

    // aboutme properties
    public $id_gallery;
    public $title;
    public $type;
    public $video_url;
    public $prev_url;
    public $image_url;
    public $date;

    public function __construct($db){
        $this->conn = $db;
    }

    public function GetInformationGallery($Param)
    {
        $Sql = 'SELECT * FROM `tblgallery` WHERE `type` =' . implode(' AND ', $Param) . 'ORDER BY id_gallery DESC';

        $stmt = $this->conn->prepare( $Sql );

        // bind id of product to be updated
//        $stmt->bindParam(1, $this->id_gallery);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to aboutme properties
        $this->id_gallery = $row['id_gallery'];
        $this->title = $row['title'];
        $this->image_url = $row['image_url'];
        $this->video_url = $row['video_url'];
        $this->prev_url = $row['prev_url'];
        $this->type = $row['type'];
        $this->date = $row['date'];

//        if ($row !== null) {
//            $data = $row;
//            return $data;
//        } else {
//            $data = array();
//            return $data;
//        }
    }

}