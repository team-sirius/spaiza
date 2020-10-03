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


(function(fun, $){
    window.addEventListener("load", ()=>fun($));
})(function($){
    "use strict";
    $(".reg").click(function(o, sel){
        $(".form-login").hide();
        $(".form-reg").show();
        $(".active").rmClass("active");
        sel.aClass("active");
        history.pushState("Sign Up", null, "?signup");
    });
    $(".login").click(function(o, sel){
        $(".form-login").show();
        $(".form-reg").hide();
        $(".active").rmClass("active");
        sel.aClass("active");
        history.pushState("Login", null, "?login");
    });
    
    $("#uname").on("keyup", function(o, _){
        if(this.value==""){
            _.parent().rmClass("success").aClass("error").find(".err-msg").html("This field is required!");
            return;
        }
        _.parent().rmClass("error");
        Post("ajax/Out/Check/username", function(){
            _.parent().rmClass("error").aClass("success");
        }).error(function(err){
            _.parent().rmClass("success").aClass("error").find(".err-msg").html(err);
        }).send({uname:this.value});
    });
    
    $("#login").on("submit", function(evt){
        evt.preventDefault();
    });
    $("#reg").on("submit", function(evt){
        evt.preventDefault();
        let data={};
        for(let i=0;i<3;i++){
            let f=$(this[i]);
            if(f.val()==""){
                f.parent().rmClass("success").aClass("error").find(".err-msg").html("This field is required!");
                return;
            }
            f.parent().rmClass("error");
            data[f.attr('name')]=f.val();
        }
        $(this[3]).attr("disabled", "").val("Loading..");
        let f=this;
        Post("ajax/In/Gate/register", function(){
            location.replace("index.php");
        }).error(function(e){
            $(f).find(".msg").aClass("error").html(e);
            $(f[3]).rmAttr("disabled", "").val("Register");
        }).send(data);
    });
    $("#login").on("submit", function(evt){
        evt.preventDefault();
        let data={};
        for(let i=0;i<2;i++){
            let f=$(this[i]);
            if(f.val()==""){
                f.parent().rmClass("success").aClass("error").find(".err-msg").html("This field is required!");
                return;
            }
            f.parent().rmClass("error");
            data[f.attr('name')]=f.val();
        }
        $(this[2]).attr("disabled", "").val("Loading..");
        let f=this;
        Post("ajax/In/Gate/login", function(){
            location.replace("index.php");
        }).error(function(e){
            $(f).find(".msg").aClass("error").html(e);
            $(f[3]).rmAttr("disabled", "").val("Register");
        }).send(data);
    });
    
    let x=location.href.split("?")[1];
    if(x=="signup"){
        $(".form-login").hide();
        $(".form-reg").show();
        $(".active").rmClass("active");
        $(".reg").aClass("active");
    }
    
}, Dom);