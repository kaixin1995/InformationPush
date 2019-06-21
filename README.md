## weixin.php是微信消息推送
## dingtalk.php是钉钉消息推送
## msg.php是查看具体消息详情

### [申请测试号地址](https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login)  |   [接口文档](https://mp.weixin.qq.com/debug/cgi-bin/readtmpl?t=tmplmsg/faq_tmpl) |   [钉钉接口文档](https://open-doc.dingtalk.com/microapp/serverapi2/qf2nxq)

钉钉测试提交:http://127.0.0.1/dingtalk.php?msg=测试提交  
微信测试提交:http://127.0.0.1/weixin.php?msg=测试提交

1.先在上面的地址中申请一个接口测试号;  
2.weixin.php第61行中填写appID和appsecret;  
3.把msg.php上传到自己的空间或者中，当然用我的也可以(http://127.0.0.1/msg.php?title=标题(可选值)&time=提交时间&msg=推送内容);  
4.修改weixin.php第67行，touser是具体推送的用户，也就是微信号(不是普通的微信号，在面板中查看)  
![微信号](https://github.com/kaixin1995/InformationPush/blob/master/image/%E5%BE%AE%E4%BF%A1%E5%8F%B7%E6%9F%A5%E7%9C%8B.png)  
5.后台创建模板，格式可以按照我的，如果修改，请同步修改weixin.php中的代码;  
![创建模板](https://github.com/kaixin1995/InformationPush/blob/master/image/%E6%96%B0%E5%A2%9E%E6%A8%A1%E6%9D%BF.png)   
6.修改weixin.php第70行，这个值是后台中的模板值;

## 推送成功
![推送成功](https://github.com/kaixin1995/InformationPush/blob/master/image/%E6%8E%A8%E9%80%81%E6%88%90%E5%8A%9F.png)  

## 详情信息
![详情信息](https://github.com/kaixin1995/InformationPush/blob/master/image/%E6%89%93%E5%BC%80%E6%8F%90%E9%86%92%E9%A1%B5%E9%9D%A2.png)  


### 代码其实很简单，没有什么技术难度，本来想到网上找一个直接用的，找了许久都没找到一个合适的，所以就借助强大的搜索引擎来写一个，提醒页面做的特别粗糙，因为美工无力，就这也是因为强行扒别人的。