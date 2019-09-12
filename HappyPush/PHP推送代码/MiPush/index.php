<?php
include_once(dirname(__FILE__) . '/autoload.php');

// 添加用到的引用
use xmpush\Builder;
use xmpush\Constants;
use xmpush\Sender;

$secret = 'GcXk4v0ER6ZGqBUszvr52A==';
$package = 'com.kaixin.mipush';

// 常量设置必须在new Sender()方法之前调用
Constants::setPackage($package);
Constants::setSecret($secret);

$sender = new Sender();
//$payload = '{"test":1,"ok":"It\'s a string"}';

//如果不存在RegId和提示文字则退出
if(!isset($_REQUEST['id'])||!isset($_REQUEST['msg'])){
   echo '{"Msg":"所填数据不全"}';
   exit;
}

//获取推送ID
$newid=$_REQUEST['id'];

//设置默认标题
$title='您有新消息请查收~';

//是否存在标题
if(isset($_REQUEST['title'])){
	$title=$_REQUEST['title'];
}


//通知任务栏id
$msgid=rand(0,4);

//是否通知任务栏id
if(isset($_REQUEST['msgid'])){
	$msgid=$_REQUEST['msgid'];
}

//信息文本
$msg=$_REQUEST['msg'];

// message1 演示自定义的点击行为
$message1 = new Builder();
$message1->title($title);  // 通知栏的title
$message1->description($msg); // 通知栏的description
$message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
//$message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
$message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
$message1->notifyId($msgid); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
$message1->build();

$SendStrs=$sender->send($message1,$newid)->getRaw();  
echo '{
  "RegId": "'.$newid.'",
  "msg": "'.$SendStrs[description].'"
}';

// 打印返回结果
//print_r($sender->send($message1,$newid)->getRaw());
?>