package com.kaixin.mipush;

public class DataMsg {
    private String Time;
    private String Title;
    private String Msg;

    public  DataMsg(String Time,String Title,String Msg)
    {
        this.Time=Time;
        this.Title=Title;
        this.Msg=Msg;
    }

    //返回日期
    public String GetTime()
    {
        return  Time;
    }

    //返回标题
    public String GetTitle()
    {
        return  Title;
    }

    //返回详细文字
    public String GetMsg()
    {
        return  Msg;
    }
}
