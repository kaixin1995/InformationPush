## 可以直接使用我打包的APK文件，当然如果想要自定义也可以看下面的教程，如果使用我打包的APK文件，直接下载后打开就可以使用。可以复制里面的推送地址，直接调用推送地址即可。[成品下载](https://www.lanzous.com/i64tj3g)

## 开心推送说明(小米推送)
- 申请一个[小米开发者账户](https://dev.mi.com/console/)，如果有小米账户可以直接登录，但是需要申请开发者权限
- 拥有开发者权限后，打开[小米推送](https://dev.mi.com/console/appservice/push.html)  
  ## 创建应用  
  ![创建应用](https://github.com/kaixin1995/InformationPush/blob/master/image/%E5%B0%8F%E7%B1%B3%E6%8E%A8%E9%80%81%E5%88%9B%E5%BB%BA%E5%BA%94%E7%94%A8.png)  
  ![填写创建应用信息](https://github.com/kaixin1995/InformationPush/blob/master/image/%E5%A1%AB%E5%86%99%E5%8C%85%E5%90%8D(%E4%B8%8D%E8%A6%81%E5%8F%98).png)  
- 创建应用，记得填写包名为:com.kaixin.mipush,至于应用名称可以随意填写
  ---
  ![查看应用信息](https://github.com/kaixin1995/InformationPush/blob/master/image/%E5%BA%94%E7%94%A8%E4%BF%A1%E6%81%AF.png)
- 记住三个值，分别为AppID、AppKey、AppSecret  
  ![替换安卓端数据](https://github.com/kaixin1995/InformationPush/blob/master/image/%E6%8E%A8%E9%80%81%E5%9C%B0%E6%96%B9%E4%BF%AE%E6%94%B9.png)
- 在安卓端中替换掉AppID、AppKey，然后重新打包即可  
  ![替换安卓端推送生成地址](https://github.com/kaixin1995/InformationPush/blob/master/image/%E6%9B%BF%E6%8D%A2%E6%8E%A8%E9%80%81%E5%9C%B0%E5%9D%80.png)
-替换推送地址生成地址，把我的域名修改为你推送端存放的地址即可  

   ---
  ![替换推送端地址中的值](https://github.com/kaixin1995/InformationPush/blob/master/image/%E6%8E%A8%E9%80%81%E7%AB%AF%E6%9B%BF%E6%8D%A2.png)
- 替换掉AppSecret的值，记住包名必须一致


  推送地址打开应用后会有显示，直接复制链接即可推送  