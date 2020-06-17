/* 
    method
    url
    data
    success 数据下载成功以后执行的函数
    error 数据下载失败以后执行的函数
    */
function $ajax({method="get",url,data,success,error}){
    var xhr = null;
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = ActiveXObject("Microsoft.XMLHTTP");
        }
        //判断如果数据存在
        if(data){
            data=querystring(data);
        }
        if(method=="get" && data){//判断data是否有数据
            url = url+"?"+data;//地址加内容
        }
        xhr.open(method,url,true);
        if(method=="get"){
            xhr.send();
        }else{
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhr.send(data);
        }

        xhr.onreadystatechange = function(){
            if(xhr.readyState==4){
                if(xhr.status==200){
                    /* 如何处理数据 */
                    //alert(xhr.responseText);//点击下载数据后，弹出显示php中最先的一个echo。
                    if(success){
                        success(xhr.responseText);//下载成功以后把xhr.responseText返回给success
                    }

                }else{
                    if(error){
                        error("Error:"+xhr.status);//下载失败以后把"Error:"+xhr.status返回给error
                    }
                }
            }
        }
    }

    function querystring(obj){
        var str = "";
        for(var attr in obj){
        str += attr+"="+obj[attr] +"&";
        }
        return str.substring(0,str.length-1);
    }
/* 
    window.onload = function(){
        var oGetBtn = document.getElementById("getBtn");
        var oPostBtn = document.getElementById("postBtn");
        //1.get请求
        oGetBtn.onclick=function(){
            $ajax({
                url:"02.php",
                data:{
                    username:"xxx",
                    age:"18",
                    password:"123abc"
                },
                success:function(result){
                    alert("GET请求下载到的数据:"+result);
                },/* 函数声明
                error:function(msg){
                    alert(msg);
                }
            })
        }
        oPostBtn.onclick=function(){
            $ajax({
                method:"post",
                url:"03.php",
                data:{
                    username:"xxx",
                    age:"18",
                    password:"123abc"
                },
                success:function(result){
                    alert("post下载到的数据:"+result);
                },
                error:function(msg){
                    alert(msg);
                }
            })
        }
    } 
   */