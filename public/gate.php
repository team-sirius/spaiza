<?php
include '../inc.php';
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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login || Nasa2020? Just change it at <?=__FILE__ . " On line ".__LINE__?></title>
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="assets/css/gate.css"/>
        <script src="assets/js/Dom.js"></script>
        <script src="assets/js/Core.js"></script>
        <script src="assets/js/Gate.js"></script>
    </head>
    <body>
        <div class="lg-root">
            <div class="lg-left">
                Some show offs here...
            </div>
            <div class="lg-form">
                <div class="top">
                    <div class="login active">Login</div>
                    <div class="reg">Register</div>
                </div>
                <div class="form-login">
                    <form method="POST" id="login">
                        <h4>Just one more step..</h1>
                        <div class="msg"></div>
                        <div class="input-gns">
                            <div class="input-wic label-tooltip">
                                <input type="text" name="uname" id="login-id" placeholder="  "/>
                                <label for="login-id">Username</label>
                                <img src="assets/images/svg/account.svg" class="icon"/>
                            </div>
                            <div class="input-wic label-tooltip">
                                <input type="password" name="pswd" id="login-pswd" placeholder="  "/>
                                <label for="login-pswd">Password</label>
                                <img src="assets/images/svg/access-hand-key.svg" class="icon"/>
                            </div>
                        </div>
                        <div class="submit">
                            <input type="submit" value="Login"/>
                        </div>
                        <div class="opt-f">Forgotten your password? You can <a href="#">recover</a> here!</div>
                    </form>
                </div>
                <div class="form-reg" data-display="flex">
                    <form method="POST" id="reg">
                        <h4>Just one more step..</h4>
                        <div class="msg"></div>
                        <div class="input-gns">
                            <div class="input-group label-tooltip">
                                <input type="text" name="name" placeholder="  " id="name"/>
                                <label for="name">Name</label>
                                <div class="err-msg"></div>
                            </div>
                            <div class="input-group label-tooltip">
                                <input type="text" name="uname" placeholder="  " id="uname"/>
                                <label for="uname">Username</label>
                                <div class="err-msg"></div>
                            </div>
                            <div class="input-group label-tooltip">
                                <input type="text" name="pswd" placeholder="  " id="pass"/>
                                <label for="pass">Password</label>
                                <div class="err-msg"></div>
                            </div>
                        </div>                        
                        <div class="submit">
                            <input type="submit" value="Register"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>