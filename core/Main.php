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
 * Description of Main
 *
 * @author Saad
 */
class Main extends DBQuery{
    public function __construct() {
        parent::__construct("mysql:host=".Cfg::HOST.";dbname=".Cfg::DATABASE.";charset=utf8mb4", Cfg::USER, Cfg::PASSWORD);
    }
    
    
    public function err():?string {
        return $this->error;
    }
    
    
    
    static function Run(){
        $Init=new Init();
        $Init->check();
    }
    
    static function setCookie(string $name, string $val, int $expire):bool {
        $_COOKIE[$name]=$val;
        if(!setcookie($name, $val, $expire, "/".Cfg::DIR)) return false;
        if(!isset($_COOKIE[$name]) || $_COOKIE[$name]!=$val){
            return false;
        }
        return true;
    }
    
    static function Log(string $tag, string $msg) {
        $dir=ROOT."/logs/$tag/".date("Y/m/d/H")."/";
        if(!file_exists($dir) && !mkdir($dir, 0777, true)){
            return;
        }
        $file=@fopen($dir.date("i")."_log.txt", 'a+');
        fwrite($file, date("[Y-m-d H:i:s]")." - $msg".PHP_EOL);
    }
}