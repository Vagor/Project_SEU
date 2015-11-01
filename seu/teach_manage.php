<?php 
	session_start();
	$_SESSION["uid"] = 1;

  $_SESSION["tid"] = 1;
?>
   <!DOCTYPE html>
   <html lang="zh-CN">
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>学生管理页</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/mystyle.css">

    <body>
      <!-- 顶部导航栏 -->

      <nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class ="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" id="brand">大学生综合素质考评系统</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="teach_manage.php" class="dropdown-toggle">选择学生</a>
              </li>

              <li>
                <a class="logout">注销登录</a>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <!-- 主要内容部分 -->
      <div class="container-fluid" >
        <div class="row">
          <!-- 左侧导航栏 -->
          <div class="col-sm-3 col-md-2 sidebar" id="sidebar-left" >
            <ul class="nav nav-sidebar">
              <li class="item_active" id="tab_mypage"><a href="#">学生管理页</a></li>
            </ul>
          </div>


          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main tab-pane" id="content_grade">

      
            <div action="" class="course-search pull-right" style="margin-top: 10px;" >

              <select type="button" class="btn btn-default dropdown-toggle btn-lg course-kind pull-middle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="select_year">
                <option><a href="#" value=1 selected="selected">入学年份</a></option>
                <option><a href="#" value=2>2009</a></option>
                <option><a href="#" value=3>2010</a></option>
                <option><a href="#" value=4>2011</a></option>
                <option><a href="#" value=5>2012</a></option>
                <option><a href="#" value=6>2013</a></option>
                <option><a href="#" value=7>2014</a></option>
                <option><a href="#" value=8>2015</a></option>
              </select>
              <select type="button" class="btn btn-default dropdown-toggle btn-lg course-kind pull-middle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="select_college">
                <option><a href="#" value=1 selected="selected">学院</a></option>
                <option><a href="#" value=2>电气学院</a></option>
                <option><a href="#" value=3>自动化学院</a></option>
                <option><a href="#" value=4>生科学院</a></option>
                <option><a href="#" value=5>电信学院</a></option>
                <option><a href="#" value=6>马克思学院</a></option>
                <option><a href="#" value=7>社会学院</a></option>
                <option><a href="#" value=8>法学院</a></option>
              </select>
              <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="select_major">
              <option><a href="#" value=1 selected="selected">&nbsp;专业&nbsp;</a></option>
              </select>
              <select type="button" class="btn btn-default dropdown-toggle btn-lg pull-middle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="select_class">
                <option><a href="#" selected="selected">班级</a></option>
                <option value=1><a href="#">1班</a></option>
                <option value=2><a href="#">2班</a></option>
                <option value=3><a href="#">3班</a></option>
                <option value=4><a href="#">4班</a></option>
                <option value=5><a href="#">5班</a></option>
              </select>
              <button type="button" class="btn btn-default btn-sm" id="stu_search" style="margin-left: 20px;">搜索</button>



            </div>


            <h1 class="page-header">学生管理页面</h1>

            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">学生列表</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <thead>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div><!-- container-fluid -->
      </div><!-- row -->
<script type="text/javascript" src="./js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/bootstrap.js"></script>
<script type="text/javascript" src="./js/teach_manage_onload.js"></script>
</body>
</html>