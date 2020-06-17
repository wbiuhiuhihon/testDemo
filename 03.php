<?php
    header('content-type:text/html;charset="utf-8"');
    /* 反馈数据格式,一个码,一个数据 */
    $responsedata = array("code"=>0,"message"=>"");
   // var_dump($_POST);/* 因为是post提交过来的数据,所以数据全都放在$_POST中 */
    $name = $_POST['name'];
    $yingyu=$_POST['yingyu'];
    $shuxue=$_POST['shuxue'];
    $yuwen=$_POST['yuwen'];

    //1.连接数据库
    $link = mysql_connect("localhost","root","123456");//连接成功会返回一个mysql对象，所以用变量接收。
     //2.判断是否链接成功
     if(!$link){
        //判断link是否有对象，没有对象执行此处
        //echo "链接失败";
        $responsedata['code']=1;
        $responsedata['message']="数据库链接失败";
        //返回到前台页面
        echo json_encode(responsedata);
        exit;//代表的意思是，只要遇到exit后续的代码就会终止运行。不在运行后面的任何代码。
    }
    //3.设置字符集
    mysql_set_charset("utf8");
    //4.选择数据库
    mysql_select_db("yyy");
    //5.准备sql语句进行插入操作
    $sql = "INSERT INTO xuesheng(name,yuwen,shuxue,yingyu) VALUES('{$name}',{$yingyu},{$shuxue},{$yuwen})";
    //6.发送sql语句
    $res = mysql_query($sql);//插入成功返回true,插入失败返回false
    //7.判断是否发送成功
    if(!$res){
        //发送失败后
        $responsedata['code']=1;
        $responsedata['message']="添加学员成绩失败";
        //返回到前台页面
        echo json_encode(responsedata);
    }else{
        //成功后
        $responsedata['message']="添加学员成绩成功";
        echo json_encode($responsedata);
    }
    //8.关闭数据库
    mysql_close($link);
?>