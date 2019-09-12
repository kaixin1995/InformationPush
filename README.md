## weixin.php是微信消息推送
## dingtalk.php是钉钉消息推送
## work.php是企业微信推送
## msg.php是查看具体消息详情
## HappyPush文件夹下是小米推送的安卓端和PHP推送端

### [申请测试号地址](https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login)  |   [接口文档](https://mp.weixin.qq.com/debug/cgi-bin/readtmpl?t=tmplmsg/faq_tmpl) |   [钉钉接口文档](https://open-doc.dingtalk.com/microapp/serverapi2/qf2nxq)  |  [企业微信接口文档](https://work.weixin.qq.com/api/doc#90002/90151/90854)  |[小米推送文档](https://dev.mi.com/console/doc/detail?pId=230)  

钉钉测试推送:http://域名/dingtalk.php?msg=测试提交    
微信测试推送:http://域名/weixin.php?msg=测试提交  
企业微信测试推送:http://域名/work.php?msg=测试提交  
小米系统级推送:http://域名/index.php?id=推送id&title=标题(可选值)&msg=测试提交数据

[微信推送说明](https://github.com/kaixin1995/InformationPush/blob/master/readme/weixin.md)  |  [企业微信推送说明](https://github.com/kaixin1995/InformationPush/blob/master/readme/work.md)   |  [开心推送(小米推送)说明](https://github.com/kaixin1995/InformationPush/blob/master/readme/MiPush.md)

### QQ推送：现在已经有了QQ推送的轮子，就不重复写了，详情可以了解一下[酷Q](https://cqp.cc/)和[CoolQ HTTP API 插件](https://cqhttp.cc/),无论是推送个人还是推送群都是十分不错的。

### 小米推送可以使用我写好的安装包，安装后打开里面会自动生成推送代码，使用http进行推送  [小米推送成品下载](https://www.lanzous.com/i64tj3g)
![成品图](https://github.com/kaixin1995/InformationPush/blob/master/image/%E5%BA%94%E7%94%A8%E6%88%AA%E5%9B%BE.png)  

### 代码其实很简单，没有什么技术难度，本来想到网上找一个直接用的，找了许久都没找到一个合适的，所以就借助强大的搜索引擎来写一个，提醒页面做的特别粗糙，因为美工无力，就这也是强行扒别人的。