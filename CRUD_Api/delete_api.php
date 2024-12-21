<?php


header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include("../CRUD_Database/config.php");
$c1 = new Config();
// include("../CRUD_Database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

    $data = file_get_contents("php://input");
    parse_str($data,$result);
    $id = $result["id"];
    $res = $c1->deleteData($id);
    if($res){
        $arr["response"] = "Data successfully deleted";
    }else{
        $arr["response"] = "Failed to delete data";
    }
} else {
    $arr["invalid_type"] = "Only DELETE type is allowed";
}

echo json_encode($arr);
