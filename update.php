<?php
header("Content-type:Application/json");
$dir = "Database";

// print_r($_GET);
// print_r(scandir($dir));
$newWidth = null;
$newBreadth = null;



foreach (scandir($dir) as $file) {
    if ($file != "." && $file != "..") {
        if ($file === $_POST["name"]) {
            $arr = json_decode(file_get_contents($dir . "/" . $file), true);

            //To Build New File
            if (empty($_POST["newWidth"])) {
                $newWidth = preg_replace('/[^0-9]/', '', $arr["width"]);
            } else {
                $newWidth = $_POST["newWidth"];
            }

            if (
                empty($_POST["newBreadth"])
            ) {
                $newBreadth = preg_replace('/[^0-9]/', '', $arr["breadth"]);

            } else {
                $newBreadth = $_POST["newBreadth"];
            }       

            $newFile = [
                "width" => $newWidth."ft",
                "breadth" => $newBreadth."ft",
                "area" => ($newWidth * $newBreadth)."sqft",
                
            ];           
            
            //To update the file
            $json = json_encode($newFile);            
            file_put_contents($dir."/".$file,$json);            
            echo json_encode(["message" => "updated successfully"]);
        }
    }
}
