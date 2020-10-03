<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Base;


/**
 * Description of Discussions
 *
 * @author Saad
 */
class Discussions extends \Main{
    public function __construct() {
        parent::__construct();
    }
    
    public function dExists(int $id, int $to = 0, int &$reply=0):?bool {
        if(!$to){
            $q = "SELECT null FROM `discussions` WHERE id = $id";
        } else {
            $q = "SELECT c.reply FROM `discussions` d LEFT JOIN `dis_cmms` c ON c.dis_id=d.id WHERE d.id = $id AND c.id = $to";
        }
        $q = $this->query($q);
        if(!$q) return null;
        if($q->rowCount() == 0){
            return false;
        }
        $reply = $q->fetchColumn();
        return true;
    }
}
