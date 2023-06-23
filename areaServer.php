<?php

header("Content-type:Application/json");

if($_SERVER["REQUEST_METHOD"] === "POST"){   

    //To create info
    $width = $_POST["width"];
    $breadth = $_POST["breadth"];
    $area = $width * $breadth;

    $info = [
        "width" => $width . "ft",
        "breadth" => $breadth . "ft",
        "area" => $area . "sqft"        
    ];

//To move uploaded_file(photo) to a folder
    $dir = "Photos";
    if(!is_dir($dir)){
        mkdir($dir);
    }
    //To Check File is Uploaded
    if( !is_null($_FILES) && $_FILES["photo"]["error"] === 0){
        $newName = $dir . "/" . uniqid() . time() . "-photo" . "." . pathinfo($_FILES["photo"]["name"])["extension"];
        move_uploaded_file($_FILES["photo"]["tmp_name"], $newName);
        $info["photo"] = $newName;
    }    

    
    //To store File
    $folderName = "Database";
    $fileName = uniqid()."-"."area"."."."json";
    if(!is_dir($folderName)){
        mkdir($folderName);
    }
    $stream = fopen($folderName."/".$fileName,"w");
    fwrite($stream,json_encode($info));
    fclose($stream);

    //Response
    header("HTTP/1.1 201 Created Successfully");
    echo json_encode($info);
}