<?php
header("Content-type:Application/json");
$dir = "Database";
$fileName = $_POST["name"];


$newWidth = null;
$newBreadth = null;

if (file_exists($dir . "/" . $fileName)) {
    //My last try method short
    $arr = json_decode(file_get_contents($dir . "/" . $fileName), true);

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
        "width" => $newWidth . "ft",
        "breadth" => $newBreadth . "ft",
        "area" => ($newWidth * $newBreadth) . "sqft"
    ];

    //To update the file
    $json = json_encode($newFile);
    file_put_contents($dir . "/" . $fileName, $json);
    echo json_encode(["message" => "updated successfully"]);

    //My first try method(long)
    // foreach (scandir($dir) as $file) {
    //     if ($file != "." && $file != "..") {
    //         if ($file === $_POST["name"]) {
    //             $arr = json_decode(file_get_contents($dir . "/" . $file), true);

    //             //To Build New File
    //             if (empty($_POST["newWidth"])) {
    //                 $newWidth = preg_replace('/[^0-9]/', '', $arr["width"]);
    //             } else {
    //                 $newWidth = $_POST["newWidth"];
    //             }

    //             if (
    //                 empty($_POST["newBreadth"])
    //             ) {
    //                 $newBreadth = preg_replace('/[^0-9]/', '', $arr["breadth"]);
    //             } else {
    //                 $newBreadth = $_POST["newBreadth"];
    //             }

    //             $newFile = [
    //                 "width" => $newWidth . "ft",
    //                 "breadth" => $newBreadth . "ft",
    //                 "area" => ($newWidth * $newBreadth) . "sqft",

    //             ];

    //             //To update the file
    //             $json = json_encode($newFile);
    //             file_put_contents($dir . "/" . $file, $json);
    //             echo json_encode(["message" => "updated successfully"]);
    //         }
    //     }
    // }
}else{
    //Error
    echo json_encode(["error" => "File not found!!"]);
    header("HTTP/1.1 404 Not Found");
    
}
