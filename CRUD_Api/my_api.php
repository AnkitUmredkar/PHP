<?php

// header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
include("../CRUD_Database/config.php");

$c1 = new Config();

$arr = [];

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
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

        if ($res) {
            $arr["response"] = "Data successfully inserted";
        } else {
            $arr["response"] = "Failed to insert data";
        }
        break;
    case "GET":
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
        break;
    case "DELETE":
        $data = file_get_contents("php://input");
        parse_str($data, $result);
        $id = $result["id"];
        $res = $c1->deleteData($id);
        if ($res) {
            $arr["response"] = "Data successfully deleted";
        } else {
            $arr["response"] = "Failed to delete data";
        }
        break;
    case "PUT":
        $data = file_get_contents("php://input");
        parse_str($data, $result);

        $id = $result["id"];
        $name = $result["name"];
        $grade = $result["grade"];
        $course = $result["course"];
        $phone = $result["phone"];

        $res = $c1->updateData($id, $name, $grade, $course, $phone);

        if ($res) {
            $arr["response"] = "Data update successfully";
        } else {
            $arr["response"] = "Failed to update data";
        }
        break;
    default:
        $arr["error"] = "Invalid request type !!";
}


echo json_encode($arr);

?>