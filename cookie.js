 /* 
        setCookie()
        getCookie()
        removeCookie()
    */
   function setCookie(name,value,{expires,path,domain,secure}){
    //设置cookie
    /* 
        expires传入对应的天数

    */
    var cookieStr = encodeURIComponent(name)+"="+encodeURIComponent(value);
    if(expires){
        cookieStr += ";expires="+afterOfDate(expires);
    }
    if(path){
        cookieStr += ";path="+path;
    }
    if(domain){
        cookieStr += ";domain="+domain;
    }
    if(secure){
        cookieStr += ";secure="+secure;
    }
    document.cookie = cookieStr;
}

function afterOfDate(n){
   var d = new Date();
   var day = d.getDate();
   d.setDate(n+day);
   return d;
}


function getCookie(name){
    //获取cookie
    var cookieStr = decodeURIComponent(document.cookie);
    var start = cookieStr.indexOf(name+"=")//返回一个字符串中 name首次出现的位置
    if(start == -1){
        return null;
    }else{
        //查询从start位置开始遇到的第一个分号
        var end = cookieStr.indexOf(";",start);
        if(end == -1){
            end=cookieStr.length
        }

        //进行字符串提取
        var str = cookieStr.substring(start,end);
        var arr = str.split("=");
        return arr[1];
    }
}


function removeCookie(name){
    //删除cookie
    document.cookie = encodeURIComponent(name)+"=;expires="+new Date(0);
}
window.onload = function(){
    var oBtn = document.getElementById("btn1");
    oBtn.onclick = function(){
        removeCookie("超级英雄");
    }
}