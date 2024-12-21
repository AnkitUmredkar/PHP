<?php

header("Access-Control-Allow-Methods: POST");
header("Content_Type: application/json");
include("my_config.php");
$c1 = new MyConfig();

$arr = [];

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        $image = $_FILES["image"];
        $name = $image["name"];
        $tmp_path = $image["tmp_name"];

        $id = uniqid(); //to generate unique identifier

        $isImageUpload = move_uploaded_file($tmp_path, "images/".$id.$name); // to fetch file from server and

        if ($isImageUpload) {
            $response = $c1->uploadImage($name, "images/".$id.$name);

            if ($response) {
                $arr["response"] = "Image uploaded successfully";
            } else {
                $arr["response"] = "Failed to upload image";
            }
        } else {
            $arr["response"] = "Failed to move image to the directory";
        }


        break;
    default:
        $arr["error"] = "Invalid request type !!";
        break;
}

echo json_encode($arr);
