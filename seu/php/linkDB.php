<?php

    //链接数据库
    @$link = mysql_connect("127.0.0.1","root","");
    if(!$link)  
    {  
     //  echo "mysql connect failed";
    }	

    //设置数据库编码	
    mysql_query("set names utf8");
    
    //选择数据库
    mysql_select_db("seu",$link);                            
?>