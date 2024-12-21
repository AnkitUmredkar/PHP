<?php


header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include("../CRUD_Database/config.php");
$c1 = new Config();
// include("../CRUD_Database/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $res = $c1->getData();
    $arr = [];
    if ($res) {
        // convert object to array
        while ($data = mysqli_fetch_assoc($res)) {
            array_push($arr, $data);
            // $arr["students"] = $students;
        }
        // $arr["data"] = $data;
    } else {
        $arr["response"] = "Data not found";
    }
} else {
    $arr["error"] = "Only GET Methods are allowed";
}

echo json_encode($arr);
