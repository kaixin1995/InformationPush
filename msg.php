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
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="robots" content="noindex,noarchive,nofollow">
        <title><?php echo $_REQUEST['title'];?></title>
        <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <style>
        .card{
            box-shadow: 0 2px 12px 0 rgba(0, 0, 0, .1);
        }
    </style>

    <div class="container mt-3 mt-md-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $_REQUEST['title'];?></h5>
                <p class="card-subtitle mb-2 text-muted"><?php echo $_REQUEST['time'];?></p>
                <p class="card-text"><?php echo $_REQUEST['msg'];?></p>
            </div>
        </div>
    </div>

</html>
