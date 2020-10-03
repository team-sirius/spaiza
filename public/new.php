<?php
require_once 'inc.php';
try{
    $Obj = new In\Discussions();
    if(isset($_POST["title"]) && isset($_POST["text"])){
        $Id = $Obj->new($_POST["title"], $_POST["text"]);
        if(!$Id){
            $Error = $Obj->err();
        } else {
            $Error = "";
        }
    }
} catch (Exception $ex) {
    $Error = $ex->getMessage();
    header("Location: gate.php");
}


function has_msg(): bool {
    global $Error, $Id;
    return isset($Error) || isset($Id);
}

function the_error(): string {
    global $Error;
    return $Error;
}

function the_id():int {
    global $Id;
    return $Id;
}

require_once ROOT."/themes/_/add_idea.php";