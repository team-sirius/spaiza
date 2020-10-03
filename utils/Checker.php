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
 * Description of Checker
 *
 * @author Saad
 */
class Checker {
    const LINK_MIN=6;
    const LINK_MAX=50;
    const NAME_MIN=3;
    const NAME_MAX=50;
    const PASS_MIN=6;
    const PASS_MAX=50;
    const TITLE_MIN=10;
    const TITLE_MAX=400;

    static function errInLink(string &$link): ?string {
        $l= strlen($link);
        if($l < self::LINK_MIN || $l > self::LINK_MAX){
            return lnTranslate("Username length must be in between ". self::LINK_MIN . " & ". self::LINK_MAX);
        }
        $spc=0;
        $sp=null;
        $psp=-1;
        for($i=0;$i<$l;$i++){
            $char=$link[$i];
            if($char=="_" || $char=="."){
                if($sp && $sp!=$char){
                    return lnTranslate("You can not use both '.' and '_' in username.");
                }
                $sp=$char;
                $spc++;
                if($spc>3){
                    return lnTranslate("Too much '$sp'");
                }
                if($i<2 || $i>$l-3){
                    return lnTranslate("'$sp' can not be in first or last two charecter.",);
                }
                if($psp+1==$i){
                    return lnTranslate("Can not use '$sp' this way.");
                }
                $psp=$i;
            }else {
                if(!is_numeric($char) && (($char=mb_ord($char, "utf8"))<97 || $char>122)){
                    return lnTranslate("Invalid charecter (".$link[$i].") detected!");
                }
            }
        }
        if($spc==0) return lnTranslate("Please use at least one '.' or '_'");
        return null;
    }
    
    static function errInUName(string &$name):?string {
        $name= trim($name);
        $l= strlen($name);
        if($l < self::NAME_MIN || $l > self::NAME_MAX){
            return lnTranslate("Name length must be in between ". self::NAME_MIN . " & ". self::NAME_MAX);
        }
        for($i=0;$i<$l;$i++){
            $char= mb_ord($name[$i], "utf8");
            if($char!=32 && ($char<97 || $char>122) && ($char<65 || $char>90)){
                return lnTranslate("Invalid charecter (".$name[$i].") detected!");
            }
        }
        return null;
    }
    
    static function errInPass(string &$pass):?string {
        $l= strlen($pass);
        if($l < self::PASS_MIN || $l > self::PASS_MAX){
            return lnTranslate("Password length must be in between ". self::PASS_MIN . " & ". self::PASS_MAX);
        }
        return null;
    }
    
    static function errInDTitle(string &$title):?string {
        $title= trim($title);
        $l= strlen($title);
        if($l < self::TITLE_MIN || $l > self::TITLE_MAX){
            return lnTranslate("Title length must be in between ". self::TITLE_MIN . " & ". self::TITLE_MAX);
        }
        return null;
    }
}

