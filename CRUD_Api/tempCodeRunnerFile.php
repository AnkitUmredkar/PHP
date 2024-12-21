<?php
$data = file_get_contents("php://input");
    parse_str($data,$result);
    $id = $result["id"];
    $res = $c1->deleteData($id);
    if($res){
        $arr["response"] = "Data successfully deleted";
    }else{
        $arr["response"] = "Failed to delete data";
    }