<?php

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
namespace In;
/**
 * Description of Gate
 *
 * @author Saad
 */
class Gate extends User{
    public function __construct() {
        parent::__construct();
    }
    
    
    public function register(string $name, string $uname, string $pass):bool {
        if(!$this->canLink($uname)) return false;
        if(($this->error=
                \Checker::errInUName($name)
                ??
                \Checker::errInPass($pass)
        ))return false;
        $t= time();
        $q="INSERT INTO `users`(name, link, photo, cover, birth, click, lref, tstamp) VALUES (:name, :un, 1, 1, '0000-00-00', $t, $t, $t)";
        $q= $this->pQuery($q, [":name"=>$name,":un"=>$uname]);
        if(!$q) return false;
        $id= $this->lastInsertId();
        $q= $this->pQuery("INSERT INTO `upswds` (uid, pswd, perms, active, tstamp) VALUES ($id, :pass, '', 1, $t)", [":pass"=> password_hash($pass, PASSWORD_ARGON2I)]);
        if(!$q) return false;
        $p= $this->lastInsertId();
        if(!$this->regLogin($id, $p, false)) return false;
        return self::setUCookie($id);
    }
    
    
    
    public function login(string $user, string $pass, bool $save): bool {
        $q="SELECT id, pswd, uid, active FROM `upswds` WHERE uid=(SELECT id FROM `users` WHERE id=:id OR link=:id)";
        $q= $this->pQuery($q, [":id"=>$user]);
        if(!$q) return false;
        if($q->rowCount()==0){
            $this->error= lnTranslate("No such user!");
            return false;
        }
        while ($row=$q->fetch(\PDO::FETCH_ASSOC)){
            if(password_verify($pass, $row["pswd"])){
                if(!$row["active"]){
                    $this->error= lnTranslate("This password has been changed!! Wasn't that you?");
                    return false;
                }
                return $this->regLogin($row["uid"], $row["id"], $save) && self::setUCookie($row["uid"]);
            }
        }
        
        $this->error= lnTranslate("Invalid password!");
        return false;
    }
    
    private function regLogin(int $uid, int $pass, bool $save):bool {
        $q="SELECT uid, cookie FROM `ulogins` WHERE uid=$uid AND pswd=$pass AND cookie=(SELECT id FROM `cookies` WHERE cookie=:coo)";
        $q= $this->pQuery($q, [":coo"=>$_COOKIE[\Cfg::COOKIE_MAIN]]);
        if(!$q || !$this->pQuery("UPDATE `ulogins` SET logged=0 WHERE cookie=(SELECT id FROM `cookies` WHERE text=:coo)", [":coo"=>$_COOKIE[\Cfg::COOKIE_MAIN]])) return false;
        $save=(int)$save;
        if($q->rowCount()> 0){
            $q="UPDATE `ulogins` SET logged=1, saved=$save WHERE cookie=".$q->fetchColumn(1);
            return (bool) $this->query($q);
        }
        $q="INSERT INTO `ulogins` (uid, pswd, lang, theme, cookie, logged, saved, tstamp) SELECT $uid, $pass, 'en', 'default', id, 1, $save, :t FROM `cookies` WHERE text=:coo";
        return (bool)$this->pQuery($q, [":coo"=>$_COOKIE[\Cfg::COOKIE_MAIN], ":t"=> time()]);
    }
    
    private static function setUCookie(int $uid) {
        return parent::setCookie(\Cfg::COOKIE_USER, $uid, time()+31536000) || //One Year
                !($this->error= lnTranslate("Please use a browser which supports cookie.."));
    }
}
