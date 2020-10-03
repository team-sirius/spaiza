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
    var Elems={}, Evts={}, Data={}, scroll, id=0, pDisplay={};
    ["div", "input", "p", "img", "textarea", "fieldset", "i", "label", "link", "script", "a", "i"].forEach(t=>Elems[t]=W.document.createElement(t));
    ["DOMMouseScroll", "wheel"].forEach(fn=>scroll = fn in W?fn:null);
    function Dom(s){
        this.length=0;
        this.isDom=true;
        if(typeof s==="object"){
            if(s instanceof HTMLElement){
                this.push(s);
            }else if(s.isDom){
                return s;
            }
        }else if(typeof s==="string"){
            s = s.split(",");
            let j = 0;
            for(;j<s.length;j++){
                let ns=W.document.querySelectorAll(s[j]), i=-1;
                while((i++ || true) && ns[i])this.push(ns[i]);
            }
        }
    }
    function forEach(obj, each){
        let i;
        if(obj.length)for(i=0;i<obj.length;i++)each(obj[i], i);
        else for(i in obj)each(obj[i], i);
    }
    function find(_, s){
        let no=new Dom();
        s = s.split(",");
        let j = 0;
        for(;j<s.length;j++){
            _.forEach(e=>{
                let ns=e.querySelectorAll(s[j]), i=-1;
                while((i++ || true) && ns[i])no.push(ns[i]);
            });
        }
        
        return no;
    }
    
    function childs(_){
        let no=new Dom();
        _.forEach(e=>{
            let ns=e.children, i=-1;
            while(i++>-1 && ns[i])no.push(ns[i]);
        });
        return no;
    }
    
    function parent(_){
        let o=new Dom();
        _.forEach(e=>{
            if(e.parentNode)o.push(e.parentNode);
        });
        return o;
    }
    function domId(e){
        if(!e["DomID"]){
            e["DomID"]=id;
            return id++;
        }
        return e["DomID"];
    }
    function call(evtObj, evt, _){
        Evts[this.DomID][evt].forEach(fn=>fn.call(this, evtObj, _));
    }
    function on(_, evt, cb){
        _.forEach(e=>{
            let id=domId(e);
            if(!Evts[id]){
                Evts[id]={};
            }
            if(!Evts[id][evt]){
                Evts[id][evt]=[];
                e.addEventListener(evt, function(evtObj){
                    call.call(this, evtObj, evt, _);
                });
            }
            Evts[id][evt].push(cb);
        });
    }
    function fire(_, evt){
        _.forEach(e=>e[evt]());
    }
    function aClass(_, cl){
        cl=cl.split(" ");
        _.forEach(e=>cl.forEach(c=>e.classList.add(c)));
    }
    function rmClass(_, cl){
        cl=cl.split(" ");
        _.forEach(e=>cl.forEach(c=>e.classList.remove(c)));
    }
    
    function hide(_, after){
        if(typeof after=="number"){
            setTimeout(()=>hide(_), after);
            return;
        }
        _.forEach(e=>{
            let id=domId(e), p=W.getComputedStyle(e)["display"];
            if(p!="none")pDisplay[id]=p;
            e.style.display="none";
        });
    }
    function show(_){
        _.forEach(e=>{
            let id=domId(e);
            e.style.display=e.getAttribute('data-display') || pDisplay[id] || "block";
        });
    }
    
    function html(_, data){
        if(typeof data=="undefined"){
            if(_[0])return _[0].innerHTML;
            return null;
        }
        if(_.length == 0)return _;
        if(typeof data=="object"){
            if(data instanceof HTMLElement){
                _[0].appendChild(data);
            }else if(data.isDom){
                data.forEach(c=>_[0].appendChild(c));
            }
        }else _[0].innerHTML=data;
        return _;
    }
    function append(_, data){
        if(!data || _.length==0){
            return;
        }
        if(typeof data=="object"){
            if(data instanceof HTMLElement){
                _[0].appendChild(data);
            }else if(data.isDom){
                data.forEach(c=>_[0].appendChild(c));
            }
        }else _[0].innerHTML += data;
    }
    function appendTo(_, to){
        if(to.isDom){
            if(to[0])_.forEach(e=>to[0].appendChild(e));
            return;
        }
        if(typeof to == "string"){
            to=W.document.querySelector(to);
        }
        if(to.nodeType)_.forEach(e=>to.appendChild(e));
    }
    function prepend(_, data){
        if(!data || _.length==0){
            return;
        }
        if(typeof data=="object"){
            if(data instanceof HTMLElement){
                _[0].insertBefore(data, _[0].childNodes[0]);
            }else if(data.isDom){
                data.forEach(c=>_[0].insertBefore(c, _[0].childNodes[0]));
            }
        }else _[0].innerHTML = data + _[0].innerHTML;
    }
    
    function insertBefore(_, of){
        if(!of || _.length==0){
            return;
        }
        
        if(typeof of!=="object"){
            of=document.querySelector(of);
        }
        if(of instanceof HTMLElement){
            _.forEach(e=>of.parentNode.insertBefore(e, of));
        }else if(of.isDom && (of=of[0])){
            _.forEach(e=>of.parentNode.insertBefore(e, of));
        }
    }
    
    function clone(_, deep, evts){
        var o=new Dom();
        if(!evts)_.forEach(e=>o.push(e.cloneNode(deep)));
        else _.forEach(e=>{
            let id = domId(e), e2=e.cloneNode(deep), id2=domId(e2);
            if(Evts[id]){
                Evts[id2]=Evts[id];
            }
            o.push(e2);
        });
        return o;
    }
    
    function attr(_, attr, val){
        if(typeof val=="undefined"){
            if(_[0])return _[0].getAttribute(attr);
            return "";
        }
        _.forEach(e=>e.setAttribute(attr, val));
        return _;
    }
    function rmAttr(_, attr){
        _.forEach(e=>e.removeAttribute(attr));
    }
    
    function propPlus(_, p, v){
        _.forEach(e=>{
            e[p]+=v;
        });
    }
    function prop(_, prope, val){
        if(typeof val=="undefined"){
            if(_[0])return _[0][prope];
            return undefined;
        }
        _.forEach(e=>e[prope]=val);
        return _;
    }
    function css(_, cp, val){
        
        if(typeof cp==="string"){
            if(typeof val=="undefined"){
                if(_[0])return _[0].style[cp];
                return undefined;
            }
            _.forEach(e=>e.style[cp]=val);
        }
        else forEach(cp, (v, k)=>{_.forEach(e=>e.style[k]=v);});
        return _;
    }
    function remove(_, c){
        if(typeof c == "string"){
            c = _.find(c);
        }else if(typeof c == "number"){
            if(!(c = _[c]))return;
        }
        if(typeof c==="object"){
            if(c.nodeType){
                (c.parentNode || W.document).removeChild(c);
            }else if(c.isDom){
                c.forEach(e=>(e.parentNode || W.document).removeChild(e));
            }
            return;
        }
        _.forEach(e=>(e.parentNode || W.document).removeChild(e));
    }
    
    Dom.prototype={
        find(selector){
            return find(this, selector);
        },
        childs(){
            return childs(this);
        },
        push(elem){
            this[this.length]=elem;
            this.length++;
            return this;
        },
        parent(){
            return parent(this);
        },
        click(callback){
            on(this, "click", callback);
            return this;
        },
        forEach(fn){
            for(let i=0;i<this.length;i++){
                fn(this[i], i);
            }
            return this;
        },
        on(evt, callback){
            on(this, evt, callback);
            return this;
        },
        fire(evt){
            fire(this, evt);
            return this;
        },
        addClass(className){
            aClass(this, className);
            return this;
        },
        aClass(className){
            aClass(this, className);
            return this;
        },
        rmClass(className){
            rmClass(this, className);
            return this;
        },
        show(){
            show(this);
            return this;
        },
        hide(after){
            hide(this, after);
            return this;
        },
        html(data){
            return html(this, data);
        },
        append(obj){
            append(this, obj);
            return this;
        },
        appendTo(obj){
            appendTo(this, obj);
            return this;
        },
        prepend(obj){
            prepend(this, obj);
            return this;
        },
        insertBefore(obj){
            insertBefore(this, obj);
            return this;
        },
        attr(name, val){
            return attr(this, name, val);
        },
        propPlus(property, value){
            propPlus(this, property, value);
            return this;
        },
        prop(property, value){
            return prop(this, property, value);
        },
        css(property, value){
            return css(this, property, value);
        },
        rmAttr(name){
            rmAttr(this, name);
            return this;
        },
        val(value){
            return prop(this, 'value', value);
        },
        eq(index){
            if(index<0)return new Dom(this[this.length + index]);
            else return new Dom(this[index]);
        },
        clone(deep){
            return clone(this, deep);
        },
        get(index){
            if(!index)return this[0];
            else if(index<0)return this[this.length + index];
            return this[index];
        },
        remove(child){
            remove(this, child);
            return this;
        }
    };
    
    
    function dom(_, data){
        if(typeof data!=="object"){
            _.html(data);
            return;
        }
        if(data.isDom){
            if(_.length>0)data.forEach(e=>_[0].appendChild(e));
            return;
        }
        if(data.nodeType){
            if(_.length>0)_[0].appendChild(data);
            return;
        }
        if(data.css){
            _.css(data.css);
            delete data.css;
        }
        
        if(data.evts){
            for(let evt in data.evts){
                _.on(evt, data.evts[evt]);
            };
            delete data.evts;
        }
        if(data.children){
            forEach(data.children, ch=>{
                _.append(ch);
            });
            delete data.children;
        }
        if(data.html){
            _.html(data.html);
            delete data.html;
        }
        
        for(let i in data){
            _.attr(i, data[i]);
        }
        
    }
    Dom.prototype.dom=function(data){
        dom(this, data);
        return this;
    };
    
    var Elems={};
    ["Div", "P", "A", "I", "H1", "H2", "H3", "H4", "H5", "H6", "Img", "Input", "Label", "Span", "Small", "Tr", "Td", "FieldSet"].forEach(tag=>{
        Elems[tag]=W.document.createElement(tag.toLowerCase());
        W[tag]=function(data){
            return new Dom(Elems[tag].cloneNode()).dom(data);
        };
    });
    
    
    W.Dom=function(selector){
        return new Dom(selector);
    };
    W.DomCore = Dom;
})(window);