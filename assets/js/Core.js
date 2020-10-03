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


(function(W){
    "use strict";
    const a=W.document.createElement("a");
    
    function doAjax(resp){
        let data;
        try{
            data=JSON.parse(resp);
        }catch(e){
            if(this.err){
                this.err("Unknown error!", {});
            }
            console.log(e, resp);
            return;
        }
        if(data.error){
            if(data.level && data.level=="die"){
                alert(data.error);
            }else if(this.err){
                this.err(data.error, data);
            }
        }else if(this.succ){
            this.succ(data.result, data);
        }
    }
    
    function ajaxData(data){
        if(typeof data!=="object")return data;
        let txt="";
        for(let i in data){
            if(typeof data[i]==="object"){
                txt+=ajaxDataDeep(data[i], i);
            }else txt+=i+"="+data[i]+"&";
        }
        return txt;
    }
    
    function ajaxDataDeep(data, pi){
        let txt="";
        for(let i in data){
            if(typeof data[i]==="object"){
                txt+=ajaxDataDeep(data[i], pi+"["+i+"]");
            }else txt+=pi+"["+i+"]="+data[i]+"&";
        }
        return txt;
    }
    
    function Ajax(url, type){
        type = type || "GET";
        url = (a.href=url) && a.href;
        this.http=new XMLHttpRequest();
        this.http.addEventListener("load", ()=>{doAjax.call(this, this.http.responseText);});
        this.http.open(type, url, true);
    }
    
    Ajax.prototype={
        on:function(evt, cb){
            this.http.addEventListener(evt, cb);
            return this;
        },
        error:function(fn){
            this.err=fn;
            return this;
        },
        success:function(fn){
            this.succ=fn;
            return this;
        },
        fail:function(fn){
            this.http.addEventListener("error", fn);
            return this;
        },
        open: function(type, url){
            url = (a.href=url) && a.href;
            this.http.open(type, url, true);
        },
        send:function(data){
            if(typeof data == "object"){
                if(!(data instanceof FormData)){
                    this.http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    data=ajaxData(data);
                }
            }
            this.http.send(data);
        }
    };
    
    function AjaxForm(elem, opts, cb){
        if(!opts){
            if(!elem.nodeType){
                opts = elem;
                elem = opts.form;
            }else{
                opts = {};
            }
        }else if(typeof opts == "string"){
            opts = {url:opts};
        }else if(typeof opts  == "function"){
            cb = opts;
            opts = {};
        }else if(!cb) cb = opts.success;
        
        if(typeof elem == "string"){
            elem = document.querySelector(elem);
        }
        let url = opts.url || elem.action,
            type = elem.method.toUpperCase(),
            ajax = new Ajax(url, type);
    
        ajax.check = fn => {opts.check = fn; return ajax;};
        ajax.submit = fn => {opts.submit = fn; return ajax;};
        
        ajax.success(cb);
        
        elem.addEventListener("submit", function(evt){
            sub(evt, opts, elem, ajax, url, type);
        });
        return ajax;
    }
    
    function sub(evt, opts, elem, ajax, url, type){
        evt.preventDefault();
        if(opts.check)for(let i=0;i<elem.length;i++)if(!opts.check(elem[i])){
            return;
        }
        let data =new FormData(elem);
        if(opts.submit && opts.submit.call(elem, evt, data)===false){
            return;
        }
        ajax.open(type, url);
        ajax.send(data);
    }
    
    W.Post=function(url, cb){
        return new Ajax(url, "POST").success(cb);
    };
    W.Get=function(url, cb){
        return new Ajax(url, "GET").success(cb);
    };
    W.AjaxForm = function(form, opts, callback){
        return new AjaxForm(form, opts, callback);
    };
})(window);