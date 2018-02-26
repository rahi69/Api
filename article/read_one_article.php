<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and aboutme files
include_once '../config/db.php';
include_once '../article/Article.php';
include_once '../validation/ValidationApi.php';

// get database connection
$database = new db();
$db = $database->getConnection();

// prepare product aboutme
$article = new Article($db);
$validation = new ValidationApi();
$articles_arr=array();
$articles_arr["records"]=array();
// set ID property of product to be edited
//$id = $article->id_article;
$article->id_article = $validation->CheckParamArticle($article->id_article);
//$article->id_article = isset($_GET['id']) ? $_GET['id'] : die();
$article->id_article = isset($_POST["id"]) ? $_POST["id"] : die();


// read the details of product to be edited
$article->readOne();

// create array
$article_item = array(
    "id_article" => $article->id_article,
    "title" => $article->title,
    "description" => html_entity_decode($article->description),
    "short_desc" => $article->short_desc,
    "image_src" => $article->image_src,

);
array_push($articles_arr["records"], $article_item);

//echo json_encode(array('Data' => $articles_arr, 'Code' => '200', 'Message' => 'Success Request'));

if($articles_arr != null) {
    echo json_encode(array('Data' => $articles_arr, 'Code' => '200', 'Message' => 'Success Request'));

}
else{
    echo json_encode(array('Code' => '400', 'Message' => 'Bad Request !!'));
}
// make it json format
//print_r(json_encode($article_arr));
?>