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

/**
 * Description of Init
 *
 * @author Saad
 */
class Init extends Main{
    static ?string $err=null;
    public function __construct() {
        parent::__construct();
    }
    
    static function initCookie(Main $pdo): bool {
        $i = 0;
        do{
            $coo= Basic::genCookie();
            if(!($q= $pdo->query("SELECT id FROM `cookies` WHERE text='$coo'"))){
                self::$err=$pdo->err();
                return false;
            }
            $i++;
        }while ($q->rowCount()!=0 && $i<9);
        if($i==9){
            self::$err= "Please try again!";
            return false;
        }
        if(!Main::setCookie(Cfg::COOKIE_MAIN, $coo, time()+31536000)){//One year
            self::$err="Setting cookie failed!";
            return false;
        }
        $q="INSERT INTO `cookies`(text, browser, tstamp) VALUES('$coo', :br, :t)";
        $q=$pdo->pQuery($q, [":br"=>$_SERVER["HTTP_USER_AGENT"], ":t"=> time()]);
        if(!$q){
            self::$err=$pdo->err();
            setcookie(Cfg::COOKIE_MAIN, "", time()-3600, "/".Cfg::DIR);
            return false;
        }
        return true;
    }
    
    private static function define(){
        define("theme", "default");
        define("ln", "en");
        define("cookie", 0);
    }


    public function check() {
        if(!isset($_COOKIE[Cfg::COOKIE_MAIN]) && !self::initCookie($this)){
            self::define();
            return;
        }
        if(!isset($_COOKIE[Cfg::COOKIE_USER])){
            self::define();
            return;
        }
        $q = "SELECT 'en' AS ln, ul.theme, p.perms, ul.cookie, ul.logged FROM `ulogins` ul LEFT JOIN `upswds` p ON p.id=ul.pswd ".
            "WHERE ul.uid=:uid AND ul.cookie=(SELECT id FROM `cookies` WHERE text=:coo)";
        $q = $this->pQuery($q, [":coo"=>$_COOKIE[Cfg::COOKIE_MAIN], ":uid"=>$_COOKIE[Cfg::COOKIE_USER]]);
        if(!$q){
            self::define();
            self::$err= $this->error;
            return;
        }
        if($q->rowCount()==0){
            self::define();
            //TODO: Send notification
            $q = $this->pQuery("DELETE FROM `ulogins` WHERE uid=:uid OR cookie=(SELECT id FROM `cookies` c WHERE c.text=:cookie);DELETE FROM `cookies` WHERE text=:cookie", [
                ":cookie"=>$_COOKIE[Cfg::COOKIE_MAIN],
                ":uid"=>$_COOKIE[Cfg::COOKIE_USER]
            ]);
            if(!$q){
                self::Log("mysql_die", $this->error);
            }
            setcookie(Cfg::COOKIE_MAIN, "", time()-3600, "/".Cfg::DIR);
            setcookie(Cfg::COOKIE_USER, 0, time()-3600, "/".Cfg::DIR);
            session_destroy();
            self::$err="Session destroyed!";
            return;
        }
        $f = $q->fetch(PDO::FETCH_OBJ);
        if(!$f->logged){
            self::$err = "Please refresh..";
        }
        define("theme", $f->theme);
        define("ln", $f->ln);
        define("cookie", $f->cookie);
    }
   
}
