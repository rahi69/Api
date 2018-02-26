<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and aboutme files
include_once '../config/db.php';
include_once '../aboutme/Aboutme.php';

// instantiate database and aboutme
$database = new db();
$db = $database->getConnection();

// initialize aboutme
$aboutme= new Aboutme($db);

// query products
$stmt = $aboutme->GetAbout();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // article array
    $aboutme_arr=array();
    $aboutme_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $aboutmeitem=array(
            "id" => $id,
            "biog" => $biog,
            "video_url" => html_entity_decode($video_url),

        );

        array_push($aboutme_arr["records"], $aboutmeitem);
    }
    echo json_encode(array('Data' => $aboutme_arr, 'Code' => '200', 'Message' => 'Success Request'));
//    echo json_encode($aboutme_arr);
}

else{
    echo json_encode(array('Code' => '400', 'Message' => 'Bad Request !!'));
}
?>