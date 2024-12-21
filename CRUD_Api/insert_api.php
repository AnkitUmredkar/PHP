<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
include("../CRUD_Database/config.php");



$c1 = new Config();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $grade = $_POST["grade"];
    $course = $_POST["course"];
    $phone = $_POST["phone"];

    $res = $c1->insertData(
        $name,
        $grade,
        $course,
        $phone
    );

    if($res){
        $arr["response"] = "Data successfully inserted";
    }
    else{
        $arr["response"] = "Failed to insert data";
    }


} else {
    $arr["error"] = "Only POST requests are allowed"; //assosative array.
}


echo json_encode($arr);

?>
