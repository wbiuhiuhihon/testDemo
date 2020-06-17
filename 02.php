<?php
    header('content-type:text/html;charset="utf-8"');
    /* 
        链接数据库  一共八个步骤

    */
    //1.连接数据库
    /* 
        第一个参数:链接数据库的IP/域名
        第二个参数：用户名
        第三个参数：数据库密码
    */
    $link = mysql_connect("localhost","root","123456");//连接成功会返回一个mysql对象，所以用变量接收。
    //2.判断是否链接成功
    if(!$link){
        //判断link是否有对象，没有对象执行此处
        echo "链接失败";
        exit;//代表的意思是，只要遇到exit后续的代码就会终止运行。不在运行后面的任何代码。
    }
    //3.设置字符集
    mysql_set_charset("utf8");
    //4.选择数据库
    mysql_select_db("yyy");
    //5.准备sql语句
    $sql = "SELECT * FROM xuesheng";//准备yyy数据库中的xuesheng表。
    //6.发送sql语句
    $res = mysql_query($sql);//拿到sql的返回值。
    //声明一个空数组
    $arr = array();
    //7.结果处理
    while($row = mysql_fetch_assoc($res)){
        array_push($arr,$row);//把当前row取出来的数据,放入arr数组中.这样就拥有一个拥有所有数据的索引数组.
    }
    echo json_encode($arr);//把数组数据转成json格式的字符串.

    //.关闭数据库
    mysql_close($link);


?>