<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Out;


/**
 * Description of Discussions
 *
 * @author Saad
 */
class Discussions extends \Base\Discussions{
    public function __construct() {
        parent::__construct();
    }
    
    public function list(int $page):?array {
        $page = ($page - 1) * 10;
        $q = "SELECT d.id, d.uid, d.text, d.title, d.tstamp, u.link, u.name, (SELECT url FROM `files` WHERE id = u.photo) AS photo, (SELECT url FROM `files` WHERE id = d.thumb) AS thumb ".
             "FROM `discussions` d LEFT JOIN `users` u ON u.id = d.uid ORDER BY tstamp DESC LIMIT $page, 10";
        $q = $this->query($q);
        if(!$q) return null;
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function post(int $id):?array {
        
        $q = "SELECT d.id, d.uid, d.text, d.title, d.tstamp, u.link, u.name, (SELECT url FROM `files` WHERE id = u.photo) AS photo, (SELECT url FROM `files` WHERE id = d.thumb) AS thumb ".
             "FROM `discussions` d LEFT JOIN `users` u ON u.id = d.uid WHERE d.id = $id";
        $q = $this->query($q);
        if(!$q) return null;
        return $q->fetch(\PDO::FETCH_ASSOC);
    }
    
    
    public function cmms(int $dis, int $to, int $page):?array {
        $page = ($page - 1) * 10;
        $q = "SELECT c.id, c.uid, c.text, c.tstamp, u.link, u.name, (SELECT url FROM `files` WHERE id = u.photo) AS photo, (SELECT COUNT(id) FROM `dis_cmms` WHERE reply = c.id) AS replies ".
             "FROM `dis_cmms` c LEFT JOIN `users` u ON u.id = c.uid WHERE dis_id = $dis AND reply = $to ORDER BY tstamp DESC LIMIT $page, 10";
        $q = $this->query($q);
        if(!$q) return null;
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
}
