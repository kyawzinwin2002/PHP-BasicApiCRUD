<?php
header("Content-type:Application/json");
$dir = "Database";
$fileName = $_GET["name"];
// print_r($_GET);
// print_r(scandir($dir));

if($_SERVER["REQUEST_METHOD"] === "DELETE"){
    //To check get method params
    if(!empty($fileName)){
    //To check file exist
        if(file_exists($dir."/".$fileName)){
            
            //MMS method
            unlink($dir."/".$fileName);
            echo json_encode(["message" => "Deleted Successfully!!"]);

            //My First Try method (long)
            // foreach (scandir($dir) as $file) {
            //     if ($file != "." && $file != "..") {
            //         if ($file === $_GET["name"]) {
            //             if (is_file($dir . "/" . $file)) {
            //                 unlink($dir . "/" . $file);
            //                 echo json_encode(["message" => "Deleted Successfully!!"]);
            //             }
            //         }
            //     }
            // }
        }else{
            //Error
            echo json_encode(["error" => "File not found!"]);
            header("HTTP/1.1 404 Not Found");
            
        }
    }else{
            //Error
        echo json_encode(["error" => "File is required!!"]);
    }
}
