<?php
    header('content-type:text/html;charset="utf-8"');
    /* 反馈数据格式,一个码,一个数据 */
    $responsedata = array("code"=>0,"message"=>"");
   // var_dump($_POST);/* 因为是post提交过来的数据,所以数据全都放在$_POST中 */
    $username = $_POST['username'];
    $password=$_POST['password'];
    $create_time=$_POST['create_time'];

    //验证用户名是否存在
    if(!$username){
        $responsedata['code']=1;
        $responsedata['message']="用户名不能为空";
        echo json_encode($responsedata);
        exit;
    }
    if(!$password){
        $responsedata['code']=2;
        $responsedata['message']="密码不能为空";
        echo json_encode($responsedata);
        exit;
    }

    //1.连接数据库
    $link = mysql_connect("localhost","root","123456");//连接成功会返回一个mysql对象，所以用变量接收。
     //2.判断是否链接成功
     if(!$link){
        //判断link是否有对象，没有对象执行此处
        //echo "链接失败";
        $responsedata['code']=3;
        $responsedata['message']="数据库链接失败";
        //返回到前台页面
        echo json_encode($responsedata);
        exit;//代表的意思是，只要遇到exit后续的代码就会终止运行。不在运行后面的任何代码。
    }
    //3.设置字符集
    mysql_set_charset("utf8");
    //4.选择数据库
    mysql_select_db("yyy");
    //5.准备sql语句,验证用户名是否重名
    $sql = "SELECT * FROM yonghu WHERE username='{$username}'";
    //6.发送sql语句
    $res = mysql_query($sql);//查找返回的结果
    //7.取一行数据
    $row = mysql_fetch_assoc($res);
    if($row){
        //如果为true,用户名重名
        $responsedata['code']=4;
        $responsedata['message']="用户名重名,不可以创建";
        //返回到前台页面
        echo json_encode($responsedata);
        exit;
    }
    //进行md5加密
    $str = md5(md5(md5($password)."xxx")."yyy");/* 把password数据加密,并且给str,md5,可以多层嵌套 */

    //不重名既可以创建,准备数据库插入操作
    $sql2 = "INSERT INTO yonghu(username,password,create_time) VALUES('{$username}','{$str}',{$create_time}) ";
    /* 这里的password放入加密之后的str就行了 */
    //发送插入sql
    $res2 = mysql_query($sql2);//返回一个布尔值
    if($res2){
        //注册成功
     //   $responsedata['code']=0;
        $responsedata['message']="注册成功";
        //返回到前台页面
        echo json_encode($responsedata);
    }else{
        //注册失败
        $responsedata['code']=5;
        $responsedata['message']="注册失败";
        //返回到前台页面
        echo json_encode($responsedata);
    }


    //8.关闭数据库
    mysql_close($link);
?>