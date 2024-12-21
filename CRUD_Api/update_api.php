<?php


header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json");

include("../CRUD_Database/config.php");
$c1 = new Config();
// include("../CRUD_Database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    $data = file_get_contents("php://input");
    parse_str($data,$result);

    
    $id = $result["id"];
    $name = $result["name"];
    $grade = $result["grade"];
    $course = $result["course"];
    $phone = $result["phone"];


    $res = $c1->updateData($id, $name, $grade, $course, $phone);
    if($res){
        $arr["response"] = "Data update successfully";
    }else{
        $arr["response"] = "Failed to update data";
    }
} else {
    $arr["invalid_type"] = "Only PUT type is allowed";
}

echo json_encode($arr);
