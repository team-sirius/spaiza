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
namespace Ajax_In;
/**
 * Description of Gate
 *
 * @author Saad
 */
class Gate extends \Ajax{
    public function register() {
        $Obj=new \In\Gate();
        $this->root["fields"]=[];
        foreach (["name", "uname", "pswd"] as $k) {
            if(!isset($_POST[$k])){
                $this->root["fields"][]=$k;
                $this->err= lnTranslate("err_req_fields");
            }
        }
        if(!$this->err){
            $this->res=$Obj->register($_POST["name"], $_POST["uname"], $_POST["pswd"]);
            $this->err=$Obj->err();
        }
    }
    public function login() {
        $Obj=new \In\Gate();
        if(!isset($_POST["uname"]) || !isset($_POST["pswd"])){
            $this->err= lnTranslate("err_req_fields");
            return;
        }
        $this->res=$Obj->login($_POST["uname"], $_POST["pswd"], isset($_POST["save"]));
        $this->err=$Obj->err();
    }
}
