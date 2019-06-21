<?php
header("Content-Type: text/html;charset=utf-8");
//此页面是为了处理各种返回值
if(!isset($_REQUEST['title'])||!isset($_REQUEST['time'])||!isset($_REQUEST['msg']))
{
  exit;
}
?>
<html>
    <head>
        <title><?php echo $_REQUEST['title'];?></title>
        
    </head>
    <style>
        .jumbotron{padding:30px;margin-bottom:30px;color:inherit;background-color:#ecf0f1}
        .jumbotron p{margin-bottom:15px;font-size:23px;font-weight:200}
        .jumbotron>hr{border-top-color:#cfd9db}
        .container .jumbotron{border-radius:6px}.jumbotron 
        .container{max-width:100%}@media screen and (min-width:768px){.jumbotron{padding-top:48px;padding-bottom:48px}
        .container .jumbotron{padding-left:60px;padding-right:60px}
    
        </style>
    
    <h1 style="color: #3290E2;"><?php echo $_REQUEST['title'];?></h1>
    <hr />
    <div class="jumbotron">
      <h2><?php echo $_REQUEST['msg'];?></h2>
      <p>提醒时间:<?php echo $_REQUEST['time'];?></p>
    </div>
</html>