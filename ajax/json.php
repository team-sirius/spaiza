<?php
header("Content-type: application/json");
include '../inc.php';

if(Init::$err){
    die(json_encode([
        "level"=>"die",
        "result"=>false,
        "error"=> Init::$err
    ]));
}
$file=ROOT."/controllers/Ajax_".$_GET["type"]."/".$_GET["class"].".php";
if(!file_exists($file)){
    echo json_encode([
        "result"=>false,
        "error"=> "Invalid url.."
    ]);
}else{
    include $file;
    if(file_exists(($file=ROOT."/langs/".ln."Ajax_".$_GET["type"]."/".$_GET["class"].".php"))){
        include $file;
    }
    
    $class="Ajax_".$_GET["type"]."\\".$_GET["class"];
    $m=$_GET["method"];
    try{
        $Obj=new $class();
        if(!method_exists($Obj, $m)){
            echo json_encode([
                "result"=>false,
                "error"=> "Invalid option.."
            ]);
        } else {
            $Obj->$m();
            $Obj->printJson();
        }
    } catch (Exception $ex) {
        echo json_encode([
                "result"=>false,
                "error"=> $ex->getMessage(),
                "level"=>"exception"
            ]);
    }
}