<?php

    error_reporting(E_ALL&~E_NOTICE);

    function urlChange($url)
    {
        header("Location: ".$url); 
        //确保重定向后，后续代码不会被执行 
        exit();
    }

    function check_input($value){
        // 去除斜杠
        if (get_magic_quotes_gpc()){
            $value = stripslashes($value);
        }
        // 如果不是数字则加引号
        if (!is_numeric($value)){
            $value = "'" . mysql_real_escape_string($value) . "'";
        }
        return $value;
    }

    /*
         下面的函数都是为了各个页面的显示

    */




     function linkDB()
    {
        //链接数据库，账号密码填自己的
        @$link = mysql_connect("127.0.0.1","root","123456");
        if(!$link)  
        {  
          echo "mysql connect failed";
        }   

        //设置数据库编码   
        mysql_query("set names utf8");
        
        //选择数据库，自己填数据库名字
        mysql_select_db("seu_tlw",$link);
    }
    //由学期，课程类型得到数据库表名称
    function getTableName($semester,$class_type)
    {
        if($semester > 0 && $semester < 8 && $class_type > 0 && $class_type < 6)
        {
            $table = $semester."_".$class_type."_score";
            return $table;
        }else{
            //echo "ERROR(1)!!";
            die();
        }
    }
    
    //由课程数据表中字段名获取中文名
    function getClassName($class_name)
    {
        $sql = "SELECT class_name FROM class WHERE name = '$class_name'";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        return $arr["class_name"];
    }

    //返回入学年份
    function returnYear($uid)
    {
        $sql = "SELECT year FROM student WHERE uid = $uid";
        $res = mysql_query($sql);
        $year = @mysql_fetch_assoc($res)["year"];
        return $year;
    }


    //由课程中文名获取数据表中字段名
    function getClassEnglishName($class_name)
    {
        $sql = "SELECT name FROM class WHERE class_name = '$class_name'";
        $res = mysql_query($sql);
       $arr = @mysql_fetch_assoc($res);
        return $arr["name"];
    }
    
    //由课程数据表中字段名获取学分
    function getClassElement($class_name)
    {
        $sql = "SELECT credit FROM class WHERE name = '$class_name'";
        $res = mysql_query($sql);
        @$arr = mysql_fetch_assoc($res);
        return $arr["credit"];
    }

    //由对应数字获取课程类型名
    function getClassTypeName($class_type)
    {
        $sql = "SELECT class_type FROM class_type WHERE id = $class_type";
        $res = mysql_query($sql);
        return @mysql_fetch_assoc($res)["class_type"];
    }

    //由课程类型名获取对应数字
    function getClassTypeByTypeName($type_name)
    {
        $sql = "SELECT id FROM class_type WHERE class_type = '$type_name'";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        return $arr["id"];
    }

    //在class_type表中由class_type获取id
    function getIdByClass_type($class_type)
    {
        $sql = "SELECT id FROM class_type WHERE class_type = '$class_type'";
        $res = mysql_query($sql);
        return @mysql_fetch_assoc($res)["id"];
    }

    //ONLY USED BY onloadSocial.php
    function onloadSocial($id)
    {
        $sql = "SELECT * FROM social_activity WHERE id = $id";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        $back = array(
                "kind" => $arr["type"],
                "date" => $arr["time"],
                "grade" => $arr["score"],
                "place" => $arr["location"],
                "content" => $arr["content"]
            );
        return $back;
    }



    //由uid,学期,课程类型获取个人成绩内容
    function getScore($uid,$semester,$class_name)
    {
       // $class_type = getIdByClass_type($class_name);
        $class_type = $class_name;
        $num = 0;
        $table = getTableName($semester,$class_type);
        $sql = "SELECT credit,class_name,name FROM class WHERE semester = $semester AND class_type = $class_type";
        $res = mysql_query($sql);
        $kind = getClassTypeName($class_type);
        while($arr = @mysql_fetch_assoc($res))
        {
            $name = $arr['name'];
            $sql2 = "SELECT $name,id FROM $table WHERE uid = $uid";
            $res2 = mysql_query($sql2);
            $arr2 = @mysql_fetch_assoc($res2);
            if($arr2[$name]){
                 $back[$num] = array(
                        "id" => $arr2["id"],
                        "course" => $arr["class_name"],
                        "credit" => $arr["credit"],
                        "grade" => $arr2[$name],
                        "kind" => $kind
                    );
                 $num++;
             }
            
        }
        return $back;
    }



    //由uid获取科技竞赛页面信息
    function getSciElement($uid)
    {
        $num = 0;
        $sql = "SELECT name,result,score,id,time FROM science WHERE uid = $uid";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $back[$num] = array(
                    "id" => $arr["id"],
                    "name" => $arr["name"],
                    "result" => $arr["result"],
                    "grade" => $arr["score"],
                    "time" => $arr["time"]
                );
            $num++;
        }
        return $back;
    }

    //由uid获取社会活动页面信息
    function getSocialElement($uid)
    {
        $num = 0;
        $sql = "SELECT `id`,`time`,`location`,`content`,`score` FROM `social_activity` WHERE uid = $uid";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $back[$num] = array(
                    "id" => $arr["id"],
                    "time" => $arr["time"],
                    "place" => $arr["location"],
                    "content" => $arr["content"],
                    "grade" => $arr["score"]
                );
            $num++;
        }
        return $back;
    }

    //根据入学年份及学期数，返回学期字符串
    function getSemester($year,$semester)
    {
        $num = 0;
        for($num;$num<$semester;$num++)
        {
            if($num == 0)
            {
                $str["$num"] = $year."学年第一学期";
            }else if($num == 1)
            {
                
                $str["$num"] = $year."学年第二学期";
            }else if($num == 2)
            {
                $year++;
                $str["$num"] = $year."学年第一学期";
            }else if($num == 3)
            {
                
                $str["$num"] = $year."学年第二学期";
            }else if($num == 4)
            {
                $year++;
                $str["$num"] = $year."学年第一学期";
            }else if($num == 5)
            {
               
                $str["$num"] = $year."学年第二学期";
            }else if($num == 6)
            {
                 $year++;
                $str["$num"] = $year."学年第一学期";
            }else if($num == 7)
            {
                
                $str["$num"] = $year."学年第二学期";
            }

        }

        return $str;
    }


    //根据uid获取个人主页内容
    function getElement($uid)
    {

        $sql = "SELECT year FROM student WHERE uid = $uid";
        $res = mysql_query($sql);
        $year = mysql_fetch_assoc($res)["year"];
        $semester = returnSemester(date("Y-m-d",time()),$year);
        $sql = "UPDATE student SET semester = $semester WHERE uid = $uid";
        mysql_query($sql);


        $sql = "SELECT * FROM student WHERE uid = $uid";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        $back[0] = array(
                'url' => $arr["photo"],
                'name' => $arr["name"],
                'stuid' => $arr["stu_id"],
                'college' => $arr["department"],
                'major' => $arr["major"],
                'nation' => $arr["nation"],
                'gender' => $arr["sex"],
                'birthday' => $arr["birth"],
                'bloodType' => $arr["blood_type"],
                'placeOfOrigin' => $arr["hometown"],
                'religion' => $arr["religion"],
                'nationality' => $arr["country"],
                'year' => $arr["year"]
            );
        $num = 0;
        $year = $arr["year"];
        $sql = "SELECT semester FROM score WHERE uid = $uid ORDER BY semester DESC";
        $res = mysql_query($sql);
        $semester = @mysql_fetch_assoc($res)["semester"];


        $str = getSemester($year,$semester);
        $sql = "SELECT semester,class_score,sci_score,social_score,sum_score FROM score WHERE uid = $uid ORDER BY semester";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $back[1][$num] = array(
                    "term" => $str[$num],
                    "grade" => $arr["class_score"],
                    "tech" => $arr["sci_score"],
                    "prac" => $arr["social_score"],
                    "total" => $arr["sum_score"]
                );
            $num++;
        }

        return $back;
    }

    /*
         下面的函数都是为了添加,删除及修改记录
    */

    //在修改或添加科技竞赛后，更新科技竞赛总成绩
    function updateSciScore($uid,$semester)
    {
        $sum = 0;
        $sql = "SELECT id,ratio FROM science_type";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $ratio = $arr["ratio"];
            $type = $arr["id"];
            $sql2 = "SELECT score FROM science WHERE uid = $uid AND type = $type AND semester = $semester";
            $res2 = mysql_query($sql2);
            while($arr2 = @mysql_fetch_assoc($res2))
            {
                $sum += $arr2["score"] * $ratio;
            }
        }

        $sql3 = "SELECT * FROM score WHERE uid = $uid AND semester = $semester";
        $res3 = mysql_query($sql3);
        if(mysql_num_rows($res3))
        {
            $sql4 = "UPDATE score SET sci_score = $sum WHERE uid = $uid AND semester = $semester";
        }else{
            $sql4 = "INSERT INTO score(uid,sci_score,semester) VALUES($uid,$sum,$semester)";
        } 

        mysql_query($sql4);
    }

    //在修改或添加社会活动后，更新社会活动总成绩
    function updateSocialScore($uid,$semester)
    {
        $sum = 0;
        $sql = "SELECT id,ratio FROM social_activity_type";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $ratio = $arr["ratio"];
            $type = $arr["id"];
            $sql2 = "SELECT score FROM social_activity WHERE uid = $uid AND semester = $semester AND type = $type";
            $res2 = mysql_query($sql2);
            while($arr2 = @mysql_fetch_assoc($res2))
            {
                $sum += $ratio * $arr2["score"];
            }
        }
        
        $sql3 = "SELECT * FROM score WHERE uid = $uid AND semester = $semester";
        $res3 = mysql_query($sql3);
        if(mysql_num_rows($res3))
        {
            $sql4 = "UPDATE score SET social_score = $sum WHERE uid = $uid AND semester = $semester";
        }else{
            $sql4 = "INSERT INTO score(uid,social_score,semester) VALUES($uid,$sum,$semester)";
        }
        mysql_query($sql4);
    }

    


    //学生修改我的主页中的内容
    function updateElement($uid,$name,$department,$nation,$birth,$hometown,$country,$stu_id,$major,$sex,$blood_type,$religion)
    {
        if(isset($name) && isset($department) && isset($nation) && isset($birth) && isset($hometown) && isset($country) && isset($stu_id) && isset($major) && isset($sex) && isset($blood_type) && isset($religion))
        {
            $name = check_input($name);
            $department = check_input($department);
            $nation = check_input($nation);
            $birth = check_input($birth);
            $hometown = check_input($hometown);
            $country = check_input($country);
            $stu_id = check_input($stu_id);
            $major = check_input($major);
            $sex = check_input($sex);
            $blood_type = check_input($blood_type);
            $religion = check_input($religion);
            $sql = "UPDATE student SET name = $name,department = $department,nation = $nation,birth = $birth,hometown = $hometown,country = $country,stu_id = $stu_id,major = $major,sex = $sex,blood_type = $blood_type,religion = $religion WHERE uid = $uid";
            if(mysql_query($sql))
            {
                return 1;
            }
        } else {
            return 0;
        }
    }

    //老师添加学生科技竞赛
    function insertSciElement($uid,$tid,$name,$time,$result,$score,$type)
    {
        if(!empty($uid) && !empty($tid) && !empty($name) && !empty($time) && !empty($result) && !empty($score) && !empty($type))
        {
            $uid = check_input($uid);
            $tid = check_input($tid);
            $name = check_input($name);
            //$time = check_input($time);
            $result = check_input($result);
            $score = check_input($score);
            $type = check_input($type);

            $sql = "SELECT year FROM student WHERE uid = $uid";
            $res = mysql_query($sql);
            $year = mysql_fetch_assoc($res)["year"];
            $semester = returnSemester($time,$year);

            if($year > date("Y",strtotime($time)))
                return 0;


            $sql = "INSERT INTO science(uid,tid,name,time,result,score,type,semester) VALUES($uid,$tid,$name,'$time',$result,$score,$type,$semester)";

            if(mysql_query($sql))
            {
                updateSciScore($uid,$semester);
                addSumScore($uid,$semester);
                addMessage($uid,1,2);
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
            
        }
    }

    //老师修改学生科技竞赛
    function updateSciElement($uid,$id,$name,$time,$result,$score,$type)
    {
        if(isset($id) && isset($name) && isset($time) && isset($result) && isset($score) && isset($type))
        {
            $id = check_input($id);
            $name = check_input($name);
           // $time = check_input($time);
            $result = check_input($result);
            $score = check_input($score);
            $type = check_input($type);

            $year = returnYear($uid);

            if($year > date("Y",strtotime($time)))
                return 0;

            $semester = returnSemester($time,$year);

            $sql = "UPDATE science SET name = $name,time = '$time',result = $result,score = $score,type = $type,semester = $semester WHERE id = $id";
            
            if(mysql_query($sql))
            {
                updateSciScore($uid,$semester);
                addSumScore($uid,$semester);
                addMessage($uid,2,2);
                return 1;
            }else{
                return 0;
            }
        }else{
            return 3;
        }
        
    }

    //老师删除学生科技竞赛
    function deleteSciElement($id)
    {
        $sql = "SELECT uid,semester FROM science WHERE id = $id";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        $uid = $arr["uid"];
        $semester = $arr["semester"];
        $sql1 = "DELETE FROM science WHERE id = $id";
        if(mysql_query($sql1))
        {
            updateSciScore($uid,$semester);
            addSumScore($uid,$semester);
            addMessage($uid,3,2);
            return 1;
        }else{
            return 0;
        }
    }

    //老师添加学生社会活动
    function insertSocialElement($uid,$tid,$time,$location,$content,$score,$type)
    {
        if(isset($uid) && isset($tid) && isset($time) && isset($location) && isset($content) && isset($score) && isset($type))
        {
            $uid = check_input($uid);
            $tid = check_input($tid);
           // $time = check_input($time);
            $location = check_input($location);
            $content = check_input($content);
            $score = check_input($score);
            $type = check_input($type);
           
            $sql = "SELECT year FROM student WHERE uid = $uid";
            $res = mysql_query($sql);
            $year = mysql_fetch_assoc($res)["year"];
            $semester = returnSemester($time,$year);

            if($year > date("Y",strtotime($time)))
                return 0;

            $sql = "INSERT INTO social_activity(uid,tid,time,location,content,score,type,semester) VALUES($uid,$tid,'$time',$location,$content,$score,$type,$semester)";
            if(mysql_query($sql))
            {
                updateSocialScore($uid,$semester);
                addSumScore($uid,$semester);
                addMessage($uid,1,3);
                return 1;
            }
        }else{
            return 0;
        }
    
    }

    //老师修改学生社会活动
    function updateSocialElement($id,$uid,$tid,$time,$type,$score,$location,$content)
    {
        if(isset($id) && isset($tid) && isset($time) && isset($type) && isset($score) && isset($location) && isset($content))
        {
            $id = check_input($id);
            $tid = check_input($tid);
           // $time = check_input($time);
            $type = check_input($type);
            $score = check_input($score);
            $location = check_input($location);
            $content = check_input($content);

            $year = returnYear($uid);
            $semester = returnSemester($time,$year);

            if($year > date("Y",strtotime($time)))
                return 0;

            $sql = "UPDATE social_activity SET tid = $tid,time = '$time',type = $type,score = $score,location = $location,content = $content,semester = $semester WHERE id = $id";
            if(!mysql_query($sql))
                return 0;
            
        }else{
            return 3;
        }
        $sql = "SELECT uid,semester FROM social_activity WHERE id = $id";
        $res = mysql_query($sql);
        $temp = @mysql_fetch_assoc($res);
        $semester = $temp["semester"];
        $uid = $temp["uid"];
        addMessage($uid,2,3);
        updateSocialScore($uid,$semester);
        addSumScore($uid,$semester);
        return 1;
    }

    //老师删除学生社会活动
    function deleteScoialElement($id)
    {
        $sql = "SELECT semester,uid FROM social_activity WHERE id = $id";
        if($res = mysql_query($sql))
        { 
            $temp = @mysql_fetch_assoc($res);
            $semester  =$temp["semester"];
            $uid = $temp["uid"];
            $sql = "DELETE FROM social_activity
             WHERE id = $id";
            if(mysql_query($sql))
            {
                updateSocialScore($uid,$semester);
                addSumScore($uid,$semester);
                addMessage($uid,3,3);

                return 1;
            }
        }
        return 0;
    }

    //删除一条个人成绩即删除数据表中一条字段
    function deleteScore($id,$class_chinese_name)
    {
        
        $class_name = getClassEnglishName($class_chinese_name);
        $sql = "SELECT semester,class_type FROM class WHERE name = '$class_name'";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        $semester = $arr["semester"];
        $class_type = $arr["class_type"];
        
        $sql2 = "SELECT class_type FROM class_type WHERE id = $class_type";
        $res2 = mysql_query($sql2);
        $type_name = @mysql_fetch_assoc($res2)["class_type"];

        $table = getTableName($semester,$class_type);

        $sql3 = "SELECT uid FROM $table WHERE id = $id";
        $res3 = mysql_query($sql3);
        $arr3 = @mysql_fetch_assoc($res3);
        $uid = $arr3["uid"];

        $sql = "UPDATE $table SET $class_name = 0 WHERE id = $id";   
        if(mysql_query($sql))
        {
            addMessage($uid,3,1);
            addAverage($uid,$semester,$class_type);
            group($uid,$semester);
            return 1;
        }else{
            return 0;
        }
        
    }

   // linkDB();
    //print_r(deleteScore());

    //修改一条个人成绩即修改数据表中一条字段
    function updateScore($uid,$semester,$type_name,$class_chinese_name,$score)
    {
        //$type = getClassTypeByTypeName($type_name);
        $type = $type_name;
        $table = getTableName($semester,$type);
        $class_type = getClassEnglishName($class_chinese_name);
        $sql = "UPDATE $table SET $class_type = $score WHERE uid = $uid";
        mysql_query($sql);
        addMessage($uid,2,1);
        addAverage($uid,$semester,$type_name);
        group($uid,$semester);
    }

    //增添一条个人成绩即修改数据表中一条字段
    function addScore($uid,$semester,$type_name,$class_chinese_name,$score)
    {
        //$type = getClassTypeByTypeName($type_name);
        $type = $type_name;
        $table = getTableName($semester,$type);
        $class_type = getClassEnglishName($class_chinese_name);
        //需先判断是否存在该uid记录
        $sql = "SELECT id FROM $table WHERE uid = $uid";
        $res = mysql_query($sql);
        if(@mysql_fetch_assoc($res)["id"])
            $sql = "UPDATE $table SET $class_type = $score WHERE uid = $uid";
        else
            $sql = "INSERT INTO $table(uid,$class_type) VALUES($uid,$score)";
        if(mysql_query($sql))
        {
            addMessage($uid,1,1);
            addAverage($uid,$semester,$type_name);
            group($uid,$semester);
            return 1;
        }else{
            return 0;
        }
        
    }

    //根据学分，学期，课程类型中文名，判断是否修改该类型科目加权值，并修改
    function addAverage($uid,$semester,$type_name)
    {
        $average = 0;
        $credit = 0;
        //$type = getClassTypeByTypeName($type_name);
        $type = $type_name;
        $table = getTableName($semester,$type);
        $sql = "SELECT name,credit FROM class WHERE semester = $semester AND class_type = $type";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $class_name = $arr["name"];
            $sql2 = "SELECT $class_name FROM $table WHERE uid = $uid";
            $res2 = mysql_query($sql2);
            $arr2 = @mysql_fetch_assoc($res2);
            if($arr2[$class_name])
            {
                $average += $arr2[$class_name] * $arr["credit"];
                $credit += $arr["credit"];
            }
           
        }
        if($credit == 0)
            $average = 0;
        else 
            $average = $average / $credit;
        

        $sql3 = "UPDATE $table SET average = $average WHERE uid = $uid";
        
        mysql_query($sql3);
    }

    //判断各种类型课程的加权平均分是否均存在，若存在，则在score表中添加class_score值
    function addClassScore($uid,$semester)
    {
        $sum = 0;
        $sql = "SELECT id,ratio FROM class_type";
        $res = mysql_query($sql);
        while($arr = @mysql_fetch_assoc($res))
        {
            $table = getTableName($semester,$arr["id"]);
            $sql2 = "SELECT average FROM $table WHERE uid = $uid";
            $res2 = mysql_query($sql2);
            $arr2 = @mysql_fetch_assoc($res2);
            if($arr2["average"])
                $sum += $arr2["average"] * $arr["ratio"];
            else{
                $sum = 0;
                break;
            }
        }
        
        $sql4 = "SELECT * FROM score WHERE uid = $uid AND semester = $semester";
        if(!mysql_query($sql4))
        {
            $sql5 = "INSERT INTO score(uid,class_score,semester) VALUES($uid,$sum,$semester)";
            mysql_query($sql5);
        }else{
        
            $sql3 = "UPDATE score SET class_score = $sum WHERE uid = $uid AND semester = $semester";
    
            mysql_query($sql3);
        
        }
    }

    //判断三种成绩是否均存在，若存在，则在score表中添加sum_score值
    function addSumScore($uid,$semester)
    {
        $sql = "SELECT class_score,sci_score,social_score FROM score WHERE uid= $uid AND semester = $semester";
        $res = mysql_query($sql);
        $arr = @mysql_fetch_assoc($res);
        if($arr["class_score"] && $arr["sci_score"] && $arr["social_score"])
        {
            $sum = $arr["class_score"] + $arr["sci_score"] + $arr["social_score"];
            $sql = "UPDATE score SET sum_score = $sum WHERE uid = $uid AND semester = $semester";
            mysql_query($sql);
        }
    }

    //
    function group($uid,$semester)
    {
        addClassScore($uid,$semester);
        addSumScore($uid,$semester);
    }

    //添加一条消息提示
    /*
        $type = 1 => 添加
        $type = 2 => 修改
        $type = 3 => 删除

        $object = 1 => 个人成绩
        $object = 2 => 科技竞赛
        $object = 3 => 社会实践

    */
    function addMessage($uid,$object,$type)
    {
        if($type == 1 && $object == 1)
            $str = "你有一条新的个人成绩于".date("Y-m-d",time())."被添加";
        else if($type == 1 && $object == 2)
            $str = "你有一条个人成绩于".date("Y-m-d",time())."被修改";
        else if($type == 1 && $object == 3)
            $str = "你有一条个人成绩于".date("Y-m-d",time())."被删除";
        else if($type == 2 && $object == 1)
            $str = "你有一条科技竞赛记录于".date("Y-m-d",time())."被添加";
        else if($type == 2 && $object == 2)
            $str = "你有一条科技竞赛记录于".date("Y-m-d",time())."被修改";
        else if($type == 2 && $object == 3)
            $str = "你有一条科技竞赛记录于".date("Y-m-d",time())."被删除";
        else if($type == 3 && $object == 1)
            $str = "你有一条社会实践记录于".date("Y-m-d",time())."被添加";
        else if($type == 3 && $object == 2)
            $str = "你有一条社会实践记录于".date("Y-m-d",time())."被修改";
        else if($type == 3 && $object == 3)
            $str = "你有一条社会实践记录于".date("Y-m-d",time())."被删除";
        
        $sql = "INSERT INTO unread(uid,message,status) VALUES($uid,'$str',1)";
        if(mysql_query($sql))
            return 1;
        else 
            return 0;
    }



    //修改时返回id对应的数据
    function returnSci($id)
    {
        $sql = "SELECT id,name,time,result,score,type FROM science WHERE id = $id";
        $res = mysql_query($sql);
        $arr = mysql_fetch_assoc($res);
        $back = array(
                "id" => $arr["id"],
                "name" => $arr["name"],
                "time" => $arr["time"],
                "result" => $arr["result"],
                "grade" => $arr["score"],
                "kind" => $arr["type"]
            );
        return $back;
    }

    //修改时返回id对应的数据
    function returnSocial($id)
    {
        $sql = "SELECT id,time,location,content,score,type FROM social_activity WHERE id = $id";
        $res = mysql_query($sql);
        $arr = mysql_fetch_assoc($res);
        $back = array(
                "id" => $arr["id"],
                "place" => $arr["location"],
                "date" => $arr["time"],
                "content" => $arr["content"],
                "grade" => $arr["score"],
                "kind" => $arr["type"]
            );
        return $back;
    }

    function returnMessage($uid)
    {
        $sql = "SELECT message FROM unread WHERE uid = $uid AND status = 1";
        $res = mysql_query($sql);
        $num = 0;
        while($arr = @mysql_fetch_assoc($res))
        {
            $back[$num++] = $arr["message"];
        }   
        return $back;
    }

    function removeMessage($uid)
    {
        $sql = "UPDATE unread SET status = 0 WHERE uid = $uid";
        if(mysql_query($sql))
            return 1;
        else
            return 0;
    }

    //根据入学年份返回学期对应数字1-8
    function returnSemester($time,$year)
    {
        $s_year = date("Y",strtotime($time));
        $s_month = date("m",strtotime($time));
        if($s_year == $year || ($s_year == ($year + 1) && ($s_month < 3)))
            return 1;
        if($s_year == ($year + 1) && $s_month >2 && $s_month < 9)
            return 2;
        if($s_year == ($year + 1) || ($s_year == ($year + 2) && ($s_month < 3)))
            return 3;
        if($s_year == ($year + 2) && $s_month >2 && $s_month < 9)
            return 4;
        if($s_year == ($year + 2) || ($s_year == ($year + 3) && ($s_month < 3)))
            return 5;
        if($s_year == ($year + 3) && $s_month >2 && $s_month < 9)
            return 6;
        if($s_year == ($year + 3) || ($s_year == ($year + 4) && ($s_month < 3)))
            return 7;
        if($s_year == ($year + 8) && $s_month >2 && $s_month < 9)
            return 8;
        return 1;
    }




    //由学院中文名返回对应专业
    function returnMajor($college_name)
    {
        $sql = "SELECT id FROM college WHERE college = '$college_name'";
        $res = mysql_query($sql);
        $id = @mysql_fetch_assoc($res)["id"];
        $sql = "SELECT major FROM major WHERE college_id = $id";
        $res = mysql_query($sql);
        $num = 0;
        while($arr = @mysql_fetch_assoc($res))
        {
            $back[$num++] = $arr["major"];
        }
        return $back;
    }

    //返回学生姓名以及uid
    function returnStu($college,$major,$year,$class)
    {
        $sql = "SELECT name,uid FROM student WHERE year = $year AND department = '$college' AND major = '$major' AND class = $class";
   
        $res = mysql_query($sql);
        $num = 0;
        while ($arr = @mysql_fetch_assoc($res)) {
            $back[$num]["uid"] = $arr["uid"];
            $back[$num++]["name"] = $arr["name"];
        }

        $a = 5 - $num % 5;
        while($a--)
        {
            $back[$num]["uid"] = "  ";
            $back[$num++]["name"] = "   ";        
        }

        return $back;
    }
?>