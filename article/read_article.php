<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and aboutme files
include_once '../config/db.php';
include_once '../article/Article.php';

// instantiate database and product aboutme
$database = new db();
$db = $database->getConnection();

// initialize aboutme
$article = new Article($db);

// query products
$stmt = $article->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // article array
    $articles_arr=array();
    $articles_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $article_item=array(
            "id_article" => $id_article,
            "title" => $title,
            "description" => html_entity_decode($description),
            "short_desc" => $short_desc,
            "image_src" => $image_src,
        );

        array_push($articles_arr["records"], $article_item);
    }

//    echo json_encode($articles_arr);
    echo json_encode(array('Data' => $articles_arr, 'Code' => '200', 'Message' => 'Success Request'));

}

else{
    echo json_encode(array('Code' => '400', 'Message' => 'Bad Request !!'));
}
?>