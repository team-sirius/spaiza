<?php
include "../inc.php";
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
if(Init::$err){
    die(Init::$err);
}

function is_logged(): bool {
    return isset($_COOKIE[Cfg::COOKIE_USER]);
}