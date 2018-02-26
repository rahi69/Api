<?php
/**
 * Created by PhpStorm.
 * User: rahi.adel
 * Date: 2/24/2018
 * Time: 4:22 PM
 */

class Gallery
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

    public function GetInfoGallery()
    {
        $GalleryModel = new GalleryModel();
        $Type = $_POST['Type'];
//        $FinalType = $this->Validation->CheckParamGallery($Type);
//        $FinalType = $this->Validation->CheckParamString($Type);
        if ($Type == false) {
            echo json_encode(array('Code' => '400', 'Message' => 'Bad Request !!'));
            exit;
        } else {
            $Param = $this->ParamSearch($Type);
            $Response = $GalleryModel->GetInformationGallery($Param);
            echo json_encode(array('Data' => $Response, 'Code' => '200', 'Message' => 'Success Request'));
            exit;
        }
    }

    private function ParamSearch($Param)
    {
        $ParamSearch = array(1);
        if ($Param >= 1) {
            $ParamSearch[] = '`type` = ' . $Param . '';
        }
        return $ParamSearch;
    }

//        // set values to aboutme properties
//        $this->title = $row['title'];
//        $this->type = $row['type'];
//        $this->video_url = $row['video_url'];
//        $this->image_url = $row['image_url'];
//        $this->prev_url = $row['prev_url'];
//        $this->date = $row['date'];
    //}
}