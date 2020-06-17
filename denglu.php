<?php
    header('content-type:text/html;charset="utf-8"');
    /* 反馈数据格式,一个码,一个数据 */
    $responseData = array("code"=>0,"message"=>"");
   // var_dump($_POST);/* 因为是post提交过来的数据,所以数据全都放在$_POST中 */
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //验证用户名是否存在
    if(!$username){
        $responseData['code']=1;
        $responseData['message']="用户名不能为空";
        echo json_encode($responseData);
        exit;
    }
    if(!$password){
        $responseData['code']=2;
        $responseData['message']="密码不能为空";
        echo json_encode($responseData);
        exit;
    }
    //1.连接数据库
    $link = mysql_connect("localhost","root","123456");//连接成功会返回一个mysql对象，所以用变量接收。
    //2.判断是否链接成功
     if(!$link){
        //判断link是否有对象，没有对象执行此处
        //echo "链接失败";
        $responseData['code']=3;
        $responseData['message']="数据库链接失败";
        //返回到前台页面
        echo json_encode($responseData);
        exit;//代表的意思是，只要遇到exit后续的代码就会终止运行。不在运行后面的任何代码。
    }
    //3.设置字符集
    mysql_set_charset("utf8");
    //4.选择数据库
    mysql_select_db("yyy");
    //进行md5加密
    $str = md5(md5(md5($password)."xxx")."yyy");
    /* 因为password是经过加密的,所以这里也要对应的加密来匹配 */
    //5.登录
    $sql = "SELECT * FROM yonghu WHERE username='{$username}' AND password='{$str}'";
    /* 因为str是经过加密的,改变了数据类型,所以要用到'' */
    //6.发送sql语句
    $res = mysql_query($sql);/* 因为是查询语句,所以返回的查询是结果 */
    //7.取出第一行数据
    $row = mysql_fetch_assoc($res);
    if(!$row){
        $responseData['code']=4;
        $responseData['message']="用户名或密码错误";
        //返回到前台页面
        echo json_encode($responseData);
    }else{
        $responseData['message']="登录成功";
        //返回到前台页面
        echo json_encode($responseData);
        //exit;//代表的意思是，只要遇到exit后续的代码就会终止运行。不在运行后面的任何代码。
    }
    //8.关闭数据库
    mysql_close($link);
?>