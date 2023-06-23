<?php

header("Content-type:Application/json");

$dir = "Database";
$fileName = $_GET["name"];

//To check existing of get method params
if(!empty($fileName)){

    //To check the existing of file in dir
    if(file_exists($dir."/".$fileName)){

        //MMS method and it is for no customization.
        // echo file_get_contents($dir."/".$fileName);

        //My first try long Method and this is useful for customization.
        // foreach (scandir($dir) as $file) {
        //     if ($file != "." && $file != "..") {
        //         if ($file === $fileName) {
        //             $arr = json_decode(file_get_contents($dir . "/" . $file), true);
        //             $arr["name"] = $fileName;
        //             echo json_encode($arr);
        //         }
        //     }
        // }

        //My method(short) and for customization;
        $arr = json_decode(file_get_contents($dir . "/" . $fileName),true);
        $arr["name"] = $fileName;
        echo json_encode($arr);

    }else{
        //Error
        echo json_encode(["error" => "File not found!"]);
        header("HTTP/1.1 404 Not Found");
    }
}else{
    //Error
    echo json_encode(["error" => "File is required!!"]);
    header("HTTP/1.1 404 Not Found");
}

