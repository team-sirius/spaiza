<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace In;


/**
 * Description of Discussions
 *
 * @author Saad
 */
class Discussions extends \Base\Discussions{
    protected int $uid;


    public function __construct() {
        parent::__construct();
        if(!isset($_COOKIE[\Cfg::COOKIE_USER])){
            throw new \Exception("You must login to add things!");
        }
        $this->uid = $_COOKIE[\Cfg::COOKIE_USER];
    }
    private static function upThumb(\Main $db, ?string &$err):?int {
        if(!isset($_FILES["thumb"])) return 0;
        return \Files::ONE($db, "thumb", function(array $file, ?string $err): bool{
            return ($err = lnTranslate("File uploading failed!")) && in_array($file["ext"], ["jpg", "png", "jpeg"]) && $file["size"]<5000000;
        }, $err);
    }
    public function new(string $title, string $text):?int {
        if(($this->error = \Checker::errInDTitle($title))){
            return null;
        }
        if(!($text = trim($text))){
            $this->error = "Invalid text!";
            return null;
        }
        $thumb = $this->upThumb($this, $this->error);
        if(is_null($thumb)) return null;
        $q = "INSERT INTO `discussions`(title, uid, text, thumb, tstamp) VALUES(:title, $this->uid, :text, $thumb, ". time().")";
        $q = $this->pQuery($q, [":title"=>$title, ":text"=>$text]);
        if(!$q) return null;
        return $this->lastInsertId();
    }
    
    
    
    public function comment(int $dis, string $text, int $to = 0):?int {
        $rep2 = 0;
        if(!$this->dExists($dis, $to, $rep2)){
            $this->error = "Invalid request..";
            return null;
        }
        if(!$rep2)$rep2 = 0;
        if(!($text = trim($text))){
            $this->error = "Invalid text!";
            return null;
        }
        $q = "INSERT INTO `dis_cmms`(dis_id, uid, text, reply, tstamp) VALUES($dis, $this->uid, :text, $rep2, ". time().")";
        $q = $this->pQuery($q, [":text"=>$text]);
        if(!$q) return null;
        return $this->lastInsertId();
    }
}
