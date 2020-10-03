<?php
include 'inc.php';
/* 
*       ------------------
*       *  Developed By: *
*       ------------------
*                                                                                dddddddd
*                SSSSSSSSSSSSSSS                                                 d::::::d
*              SS:::::::::::::::S                                                d::::::d
*             S:::::SSSSSS::::::S                                                d::::::d
*             S:::::S     SSSSSSS                                                d:::::d 
*             S:::::S              aaaaaaaaaaaaa     aaaaaaaaaaaaa       ddddddddd:::::d 
*             S:::::S              a::::::::::::a    a::::::::::::a    dd::::::::::::::d 
*              S::::SSSS           aaaaaaaaa:::::a   aaaaaaaaa:::::a  d::::::::::::::::d 
*               SS::::::SSSSS               a::::a            a::::a d:::::::ddddd:::::d 
*                 SSS::::::::SS      aaaaaaa:::::a     aaaaaaa:::::a d::::::d    d:::::d 
*                    SSSSSS::::S   aa::::::::::::a   aa::::::::::::a d:::::d     d:::::d 
*                         S:::::S a::::aaaa::::::a  a::::aaaa::::::a d:::::d     d:::::d 
*                         S:::::Sa::::a    a:::::a a::::a    a:::::a d:::::d     d:::::d 
*             SSSSSSS     S:::::Sa::::a    a:::::a a::::a    a:::::a d::::::ddddd::::::dd
*             S::::::SSSSSS:::::Sa:::::aaaa::::::a a:::::aaaa::::::a  d:::::::::::::::::d
*             S:::::::::::::::SS  a::::::::::aa:::a a::::::::::aa:::a  d:::::::::ddd::::d
*              SSSSSSSSSSSSSSS     aaaaaaaaaa  aaaa  aaaaaaaaaa  aaaa   ddddddddd   ddddd
*
*            ______________________________________________________________________________
*                
*                            Email: sakib.saad.khan@gmail.com
*                            ++++++++++++++++++++++++++++++++
*
 */

$Obj = new Out\Discussions();
$page = (int)($_REQUEST["page"]??1);
$ListAll = $Obj->list($page);
$Max = sizeof($ListAll);
$Cursor = 0;
$Item = null;
$Error = $Obj->err();

function has_posts(): bool {
    global $ListAll;
    return !empty($ListAll);
}

function has_post(): bool {
    global $Item, $ListAll, $Cursor, $Max;
    if($Cursor == $Max) return false;
    $Item = $ListAll[$Cursor];
    $Cursor++;
    return true;
}



function the_id(): string {
    global $Item;
    return $Item["id"];
}

function the_title(): string {
    global $Item;
    return $Item["title"];
}

function the_name(): string {
    global $Item;
    return $Item["name"];
}
function the_photo(): ?string {
    global $Item;
    return $Item["photo"];
}

function the_text(): string {
    global $Item;
    return $Item["text"];
}

function the_uid(): string {
    global $Item;
    return $Item["uid"];
}
function the_thumb(): ?string {
    global $Item;
    return $Item["thumb"];
}

function the_time(): int {
    global $Item;
    return $Item["tstamp"];
}

function prev_page(): int {
    global $page;
    if($page > 1){
        return $page-1;
    }
    return false;
}

function next_page(): int {
    global $page, $Max;
    if($Max == 10){
        return $page+1;
    }
    return false;
}

include ROOT."/themes/_/index.php";