<?php
header("Content-type: application/javascript");
include '../inc.php';

$fun=$_GET["fun"];
$script=$_GET["script"]??"";
if(Init::$err){
    die("(function(fun){fun(". json_encode([
        "level"=>"die",
        "result"=>false,
        "error"=> Init::$err
    ]).", \"$script\");})($fun);");
}
$file=ROOT."/controllers/Ajax_".$_GET["type"]."/".$_GET["class"].".php";
if(!file_exists($file)){
    echo "(function(fun){fun(". json_encode([
        "result"=>false,
        "error"=> "Invalid url.."
    ]).", \"$script\");})($fun);";
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
            echo "(function(fun){fun(". json_encode([
                "result"=>false,
                "error"=> "Invalid option.."
            ]).", \"$script\");})($fun);";
        } else {
            $Obj->$m();
            $Obj->printJs($fun, $script);
        }
    } catch (Exception $ex) {
        echo "(function(fun){fun(". json_encode([
            "result"=>false,
            "level"=>"exception",
            "error"=>$ex->getMessage()
        ]).", \"$script\");})($fun);";
    }
}