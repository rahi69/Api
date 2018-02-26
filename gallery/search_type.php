<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// instantiate database and product aboutme
include_once '../config/db.php';
include_once '../gallery/GalleryTest.php';

// initialize aboutme
// get database connection
$database = new db();
$db = $database->getConnection();

$gallery= new GalleryTest($db);

// get keywords
$keywords=isset($_POST["type"]) ? $_POST["type"] : "";
// get keywords
//$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// query products
$stmt = $gallery->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // products array
    $gallery_arr=array();
    $gallery_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

//        $gallery_item=array(
//            "id_gallery" => $gallery->id_gallery,
//            "title" => $gallery->title,
//            "image_url" => $gallery->image_url,
//            "video_url" => $gallery->video_url,
//            "prev_url" => $gallery->prev_url,
//            "type" => $gallery->type,
//        );

        $gallery_item=array(
            "id_gallery" => $id_gallery,
            "title" => $title,
            "image_url" => $image_url,
            "video_url" => $video_url,
            "prev_url" => $prev_url,
            "date" => $date,
        );

        array_push($gallery_arr["records"], $gallery_item);
    }

//    echo json_encode($gallery_arr);
    echo json_encode(array('Data' => $gallery_arr, 'Code' => '200', 'Message' => 'Success Request'));
    exit();

}

else{
    echo json_encode(array('Code' => '400', 'Message' => 'Bad Request !!'));
    exit();
}
?>