<?php
header("Content-type:Application/json");
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $width = $_POST["width"];
    $breadth = $_POST["breadth"];
    $area = $width * $breadth;

    $info = [
        "width" => $width."ft",
        "breadth" => $breadth."ft",
        "area" => $area."sqft"
    ];

    $folderName = "Database";
    $fileName = uniqid()."-"."area"."."."json";
    if(!is_dir($folderName)){
        mkdir($folderName);
    }
    $stream = fopen($folderName."/".$fileName,"w");
    fwrite($stream,json_encode($info));
    fclose($stream);


    echo json_encode($info);
}