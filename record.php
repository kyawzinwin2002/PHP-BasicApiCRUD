<?php
header("Content-type:Application/json");
$records = [];
$dir = "Database";


// print_r(scandir("Database"));

$arr = scandir("Database");
foreach($arr as $file){
    if($file != "." && $file != ".."){
        $data = json_decode(file_get_contents($dir."/".$file),true);        
        $data["name"] = $file;        
        array_push($records,$data);        
    }
}

$json = json_encode($records);
echo $json;