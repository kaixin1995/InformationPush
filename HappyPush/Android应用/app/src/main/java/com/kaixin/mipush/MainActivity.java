package com.kaixin.mipush;

import android.content.Context;
import android.net.wifi.WifiManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;

import java.util.List;
import java.util.concurrent.CopyOnWriteArrayList;

public class MainActivity extends AppCompatActivity {

    public static List<String> logList = new CopyOnWriteArrayList<String>();

    private static EditText NewUrl = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        NewUrl=findViewById(R.id.url);
        //Log.d("newId",NewId);
        Button btn=findViewById(R.id.ComeBack);
        btn.setOnClickListener(new View.OnClickListener(){
            @Override
            public  void onClick(View v)
            {
                refreshLogInfo();

            }
        });

        /*数组无法直接传递给ListView，这里借助适配器来完成
           里面只有一个ListView,可用于简单的显示一本文本*/
        ArrayAdapter<String> adapter =new ArrayAdapter<String>(
          //将数组的数据格式化
         MainActivity.this,android.R.layout.simple_list_item_1,logList);

        ListView listView=(ListView)findViewById(R.id.list_view);
        //数据展示到ListView中
        listView.setAdapter(adapter);
    }


    public synchronized static String getMacAddress(Context mContext) {
        WifiManager wm = (WifiManager)mContext.getSystemService(mContext.WIFI_SERVICE);
        String macAddress = wm.getConnectionInfo().getMacAddress();
        return macAddress.replace(":", "");
    }

    @Override
    protected void onResume() {
        super.onResume();
        refreshLogInfo();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        MyApplication.setMainActivity(null);
    }



    //重写这个方法，主要用来存储唯一id
    public void refreshLogInfo() {

        EditText UrlStr=findViewById(R.id.url);

        if(DemoMessageReceiver.mRegId==null){
            UrlStr.setText("唯一值获取失败，请重新获取！");
        }
        else{
            //获取前台显示网址的控件
            UrlStr.setText("https://script.haokaikai.cn/MiPush/index.php?id="+DemoMessageReceiver.mRegId+"&title=标题(可选值)&msg=测试提交数据");

        }

    }
}
