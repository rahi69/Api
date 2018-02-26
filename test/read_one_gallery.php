<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Credentials: true");
//header('Content-Type: application/json');
//
//// include database and aboutme files
//include_once '../config/db.php';
//include_once '../aboutme/GalleryModel.php';
//
//// get database connection
//$database = new db();
//$db = $database->getConnection();
//
//// prepare product aboutme
//$GalleryModel = new GalleryModel($db);
//
////$articles_arr=array();
////$articles_arr["records"]=array();
//
//$Type = $_POST['Type'];
//if ($Type == false) {
//    echo json_encode(array('Code' => '400', 'Message' => 'Bad Request !!'));
//    exit;
//} else {
//    $Param = $this->ParamSearch($Type);
//    $Response = $GalleryModel->GetInformationGallery($Param);
//    echo json_encode(array('Data' => $Response, 'Code' => '200', 'Message' => 'Success Request'));
//    exit;
//
//}
//
//private function ParamSearch($Param)
//{
//    $ParamSearch = array(1);
//    if ($Param >= 1) {
//        $ParamSearch[] = '`type` = ' . $Param . '';
//    }
//    return $ParamSearch;
//}
//
////// read the details of product to be edited
////$article->readOne();
////
////// create array
////$article_item = array(
////    "id_article" => $article->id_article,
////    "title" => $article->title,
////    "description" => html_entity_decode($article->description),
////    "short_desc" => $article->short_desc,
////    "image_src" => $article->image_src,
////
////);
////array_push($articles_arr["records"], $article_item);
////
////echo json_encode($articles_arr);
//
//// make it json format
////print_r(json_encode($article_arr));
//

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and aboutme files
include_once '../config/db.php';
include_once '../aboutme/GalleryModel.php';

// get database connection
$database = new db();
$db = $database->getConnection();

// prepare product aboutme
$gallery = new GalleryModel($db);
$articles_arr=array();
$articles_arr["records"]=array();
// set ID property of product to be edited
$Type = $gallery->type;
// $Type= isset($_GET['type']) ? $_GET['type'] : die();
$Type= isset($_POST['type']) ? $_POST['type'] : die();

//$Type = $_POST['Type'];

// read the details of product to be edited
$Param = ParamSearch($Type);
$Response = $gallery->GetInformationGallery($Param);

//$gallery->GetInformationGallery();

function ParamSearch($Param)
{
    $ParamSearch = array(1);
    if ($Param >= 1) {
        $ParamSearch[] = '`type` = ' . $Param . '';
    }
    return $ParamSearch;
}
// create array
    $Response = array(
        "id_gallery" => $gallery->id_gallery,
        "title" => $gallery->title,
       "image_url" => $gallery->image_url,
       "video_url" => $gallery->video_url,
       "prev_url" => $gallery->prev_url,

    );
//    array_push($articles_arr["records"], $Response);
//
//echo json_encode($articles_arr);
    echo json_encode(array('Data' => $Response, 'Code' => '200', 'Message' => 'Success Request'));



// make it json format
//print_r(json_encode($article_arr));
?>