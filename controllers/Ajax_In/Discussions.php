<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Ajax_In;


/**
 * Description of Discussions
 *
 * @author Saad
 */
class Discussions extends \Ajax{
    private \In\Discussions $Obj;
    public function __construct() {
        $this->Obj = new \In\Discussions();
    }
    
    public function new() {
        if(!isset($_POST["title"]) || !isset($_POST["text"])){
            $this->err = "Invalid form!";
            return;
        }
        $this->res = $this->Obj->new($_POST["title"], $_POST["text"]);
        $this->err = $this->Obj->err();
    }
    
    public function cmm() {
        if(!isset($_POST["dis"]) || !isset($_POST["text"])){
            $this->err = "Invalid form!";
            return;
        }
        $this->res = $this->Obj->comment($_POST["dis"], $_POST["text"], $_POST["to"]??0);
        $this->err = $this->Obj->err();
    }
}
