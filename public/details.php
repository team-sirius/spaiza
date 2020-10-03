<?php

require 'inc.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$Obj = new Out\Discussions();

if (!isset($_GET["id"])) {
    $Error = "Invalid id provided..";
} else {
    $Item = $Obj->post($_GET["id"]);
    $Error = $Obj->err();
    $page = (int) ($_REQUEST["page"] ?? 1);
}

function is_post(): bool {
    global $Item;
    return isset($Item) && $Item;
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

function the_username(): string {
    global $Item;
    return $Item["link"];
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
    if ($page > 1) {
        return $page - 1;
    }
    return false;
}

function next_page(): int {
    global $page, $CmmLen;
    if ($CmmLen == 10) {
        return $page + 1;
    }
    return false;
}

function has_cmms(): bool {
    global $Obj, $Cmms, $page, $CmmLen, $Error;
    $Cmms = $Obj->cmms($_REQUEST["id"], 0, $page);
    $Error = $Obj->err();
    $CmmLen = sizeof($Cmms);
    return $CmmLen > 0;
}

$Cursor = 0;

function has_cmm(): bool {
    global $Cursor, $Cmms, $CmmLen, $Item;
    if ($CmmLen == $Cursor) {
        return false;
    }
    $Item = $Cmms[$Cursor];
    $Cursor++;
    return true;
}

function sub_count(): int {
    global $Item;
    return $Item["replies"];
}

if (isset($_POST["dis"]) && isset($_POST["text"])) {
    try {
        $ObjI = new In\Discussions();
        $ObjI->comment($_POST["dis"], $_POST["text"], $_POST["to"] ?? 0);
        $CError = $ObjI->err();
    } catch (Exception $ex) {
        $CError = $ex->getMessage();
    }
}


function has_msg(): bool {
    global $CError;
    return isset($CError);
}

function the_error(): string {
    global $CError;
    return $CError;
}


include ROOT . "/themes/_/details.php";
