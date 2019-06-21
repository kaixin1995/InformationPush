<?php  
function request_by_curl($remote_server, $post_string) {  
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $remote_server);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);                
    return $data;  
}  

if(!isset($_REQUEST['msg']))
{
  exit;
}

//提交的地址
$webhook = "https://oapi.dingtalk.com/robot/send?access_token=机器人值";
//推送的文本内容
$message=$_REQUEST['msg'];
$data = array ('msgtype' => 'text','text' => array ('content' => $message));
$data_string = json_encode($data);

$result = request_by_curl($webhook, $data_string);  
echo $result;
?>