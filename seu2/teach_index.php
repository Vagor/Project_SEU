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
                <a href="#" class="dropdown-toggle">选择学生</a>
              </li>

              <li>
                <a href="">注销登录</a>
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
              <li class="item_active" id="tab_mypage"><a href="#">学生的个人主页</a></li>
              <li id="tab_grade"><a href="#">学生的个人成绩</a></li>
              <li id="tab_tech"><a href="#">学生的科技竞赛</a></li>
              <li id="tab_prac"><a href="#">学生的社会实践</a></li>
            </ul>
          </div>

          <!-- 右侧内容部分 我的主页 -->
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main tab-pane active" id="content_mypage" style="display: block;">


            <button type="button" class="btn btn-default btn-sm pull-right" id="btn-change" data-toggle="modal" data-target="" style="position: relative;
            bottom: -5px;">修改</button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close btn-personal-infro-change-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">确认提示</h4>
                  </div>
                  <div class="modal-body">
                    确定要保存您的新数据吗？
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-personal-infro-change-dismiss" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary btn-personal-infro-change-confirm" data-dismiss="modal">确定</button>
                  </div>
                </div>
              </div>
            </div><!-- modal-->

            <h1 class="page-header">学生个人主页</h1>
            <!-- 个人信息部分 -->
            <!-- 个人信息 -->
            <div style="height: 400px;">
              <!-- 个人信息左侧 -->
              <div class="personal-infro-l col-md-3">
                <img src="images/id-photo.jpg"  alt="..." class="img-rounded" id="stu-photo" style="width: 127px;
                height: 178px;" alt="登记照片，由注册中心、教务处、研究生院以及人事处负责维护个别的照片更新。">
                <br>
                <span style="margin-left: 20px;
                margin-top: 5px;"><b>在校登记照片</b></span>
              </div>
              <!-- 个人信息右侧 -->


              <div class="personal-infro-r col-md-9">
                <div class="mypage-input-group input-group pull-left">
                  <span class="input-group-addon" id="basic-addon1">姓名：</span>
                  <input type="text" id="infro-name" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="name" value="">
                </div>
                <div class="mypage-input-group input-group pull-right">
                  <span class="input-group-addon" id="basic-addon1">学号：</span>
                  <input type="text" id="infro-stuid" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="stuid" value="">
                </div>
                <div class="mypage-input-group input-group pull-left">
                  <span class="input-group-addon" id="basic-addon1">院系：</span>
                  <input type="text" id="infro-college" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="college" value="">
                </div>
                <div class="mypage-input-group input-group pull-right">
                  <span class="input-group-addon" id="basic-addon1">专业：</span>
                  <input type="text" id="infro-major" class="form-control personal-infro-input" disabled="true"  aria-describedby="basic-addon1" data-value="major" value="">
                </div>
                <div class="mypage-input-group input-group pull-left">
                  <span class="input-group-addon" id="basic-addon1">民族：</span>
                  <input type="text" id="infro-nation" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="nation" value="">
                </div>
                <div class="mypage-input-group input-group pull-right">
                  <span class="input-group-addon" id="basic-addon1">性别：</span>
                  <input type="text" id="infro-gender" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="gender" value="">
                </div>
                <div class="mypage-input-group input-group pull-left">
                  <span class="input-group-addon" id="basic-addon1">生日：</span>
                  <input type="text" id="infro-birthday" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="birthday" value="">
                </div>
                <div class="mypage-input-group input-group pull-right">
                  <span class="input-group-addon" id="basic-addon1">血型：</span>
                  <input type="text" id="infro-bloodType" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="bloodType" value="">
                </div>
                <div class="mypage-input-group input-group pull-left">
                  <span class="input-group-addon" id="basic-addon1">籍贯：</span>
                  <input type="text" id="infro-placeOfOrigin" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="placeOfOrigin" value="">
                </div>
                <div class="mypage-input-group input-group pull-right">
                  <span class="input-group-addon" id="basic-addon1">宗教：</span>
                  <input type="text" id="infro-religion" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="religion" value="">
                </div>
                <div class="mypage-input-group input-group pull-left ">
                  <span class="input-group-addon" id="basic-addon1">国籍：</span>
                  <input type="text" id="infro-nationality" class="form-control personal-infro-input" disabled="true" aria-describedby="basic-addon1" data-value="nationality" value="">
                </div>
              </div>
            </div>

            <hr>
            <!-- 个人成绩 -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">考评成绩</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>学期数</th>
                      <th>个人成绩综合得分</th>
                      <th>科技竞赛综合得分</th>
                      <th>社会实践综合得分</th>
                      <th>综合素质考评总分</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div><!-- 右侧内容部分 我的主页 -->

          <!-- 右侧内容部分 个人成绩-->
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main tab-pane" id="content_grade" style="display: none;">


            <div action="" class="course-search pull-right" style="margin-top: 10px;" >
              <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="select_term">
              </select>
              <select type="button" class="btn btn-default dropdown-toggle btn-lg course-kind pull-middle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="select_kind">
                <option value=1><a href="#" selected="selected">基础课</a></option>
                <option value=2><a href="#">专业课</a></option>
                <option value=3><a href="#">必选课</a></option>
                <option value=4><a href="#">任选课</a></option>
                <option value=5><a href="#">人文课</a></option>
              </select>
            </div>


            <h1 class="page-header">个人成绩</h1>

            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"></h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>学科</th>
                      <th>学分</th>
                      <th>分数</th>
                      <th>类别</th>
                      <th><a href="#" data-toggle="modal" data-target="#add_grade" class="add_data_grade pull-right" style="margin-right: 5px;">添加</a></th>
                    </tr>
                  </thead>
                      <!-- 添加Modal -->
                      <div class="modal fade add_data_grade" id="add_grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document" style="width: 420px;">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="exampleModalLabel">添加一条新数据</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group" style="">
                                <div class="" style="width: 172px;display: inline-block;margin: 10px;">
                                  <label for="message-text" class="control-label">学期:</label>
                                  <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;" id="add_data_grade_term" >
                                  </select>
                                </div>
                                <div class="" style="width: 172px;display: inline-block;margin: 10px;">
                                  <label for="message-text" class="control-label">类别:</label>
                                  <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;" id="add_data_grade_kind">
                                    <option value=1><a href="#" selected="selected">基础课</a></option>
                                    <option value=2><a href="#">专业课</a></option>
                                    <option value=3><a href="#">必选课</a></option>
                                    <option value=4><a href="#">任选课</a></option>
                                    <option value=5><a href="#">人文课</a></option>
                                  </select>
                                </div>
                                <div class="" style="width: 172px;display: inline-block;margin: 10px;">
                                  <label for="message-text" class="control-label">学科:</label>
                                  <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;" id="add_data_grade_course">
                                  </select>
                                </div>
                                <div class="" style="width: 172px;display: inline-block;margin: 10px;">
                                  <label for="message-text" class="control-label">评分:</label>
                                  <input type="text" class="form-control" placeholder="百分制" aria-describedby="sizing-addon1" id="add_data_grade_grade">
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal" id="add_data_grade_save">保存</button>
                            </div>
                          </div>
                        </div>
                      </div><!-- 添加Modal -->

                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- 右侧内容部分 个人成绩-->

          <!-- 右侧内容部分 科技竞赛 -->
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main tab-pane" id="content_tech" style="display: none;">
            <h1 class="page-header">科技竞赛</h1>           
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"></h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>比赛名称</th>
                      <th>比赛时间</th>
                      <th>获奖结果</th>
                      <th>老师评分</th>
                      <th><a href="#" data-toggle="modal" data-target="#add_tech" class="add_data_tech pull-right" style="margin-right: 5px;">添加</a></th>

                    </tr>
                  </thead>
                  <!-- 添加Modal -->
                      <div class="modal fade" id="add_tech" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="exampleModalLabel">添加一条新数据</h4>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="form-group" style="height: 59px;">
                                  <div class="pull-left">
                                    <label for="message-text" class="control-label">时间:</label>
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" aria-describedby="sizing-addon1" id="add_data_tech_time">
                                  </div>
                                  <div class="" style="width: 172px;display: inline-block;margin-left: 25px;">
                                    <label for="message-text" class="control-label">类别:</label>
                                    <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;" id="add_data_tech_kind">
                                      <option value=1 selected="selected"><a href="#">校级SRTP</a></option>
                                      <option value=2><a href="#">省创</a></option>
                                      <option value=3><a href="#">国创</a></option>
                                      <option value=4><a href="#">挑战杯</a></option>
                                      <option value=5><a href="#">课外研学讲座</a></option>
                                      <option value=6><a href="#">其他</a></option>
                                    </select>
                                  </div>
                                  <div class="pull-right">
                                    <label for="message-text" class="control-label">评分:</label>
                                    <input type="text" class="form-control" placeholder="百分制" aria-describedby="sizing-addon1" id="add_data_tech_grade">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="control-label">比赛全名:</label>
                                  <input type="text" class="form-control" id="add_data_tech_name">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="control-label">获奖结果:</label>
                                  <textarea class="form-control" id="add_data_tech_result"></textarea>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal" id="add_data_tech_save">保存</button>
                            </div>
                          </div>
                        </div>
                      </div> <!-- 添加Modal -->
                      <!-- 修改Modal -->
                      <div class="modal fade" id="change_tech" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="exampleModalLabel">修改一条新数据</h4>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="form-group" style="height: 59px;">
                                  <div class="pull-left">
                                    <label for="message-text" class="control-label">时间:</label>
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" aria-describedby="sizing-addon1" id="change_data_tech_time">
                                  </div>
                                  <div class="" style="width: 172px;display: inline-block;margin-left: 25px;">
                                    <label for="message-text" class="control-label">类别:</label>
                                    <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;" id="change_data_tech_kind">
                                      <option value=1 selected="selected"><a href="#">校级SRTP</a></option>
                                      <option value=2><a href="#">省创</a></option>
                                      <option value=3><a href="#">国创</a></option>
                                      <option value=4><a href="#">挑战杯</a></option>
                                      <option value=5><a href="#">课外研学讲座</a></option>
                                      <option value=6><a href="#">其他</a></option>
                                    </select>
                                  </div>
                                  <div class="pull-right">
                                    <label for="message-text" class="control-label">评分:</label>
                                    <input type="text" class="form-control" placeholder="百分制" aria-describedby="sizing-addon1" id="change_data_tech_grade">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="control-label">比赛全名:</label>
                                  <input type="text" class="form-control" id="change_data_tech_name">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="control-label">获奖结果:</label>
                                  <textarea class="form-control" id="change_data_tech_result"></textarea>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal" id="change_data_tech_save">保存</button>
                            </div>
                          </div>
                        </div>
                      </div> <!-- 修改Modal -->
                  <tbody>
                    
                    </tbody>
                  </table>
                </div>
              </div>
          </div><!-- 右侧内容部分 科技竞赛 -->

          <!-- 右侧内容部分 社会实践 -->
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main tab-pane" id="content_prac" style="display: none;">
            <h1 class="page-header">社会实践</h1>           
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"></h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>日期</th>
                      <th>地点</th>
                      <th>内容</th>
                      <th>老师评分</th>
                      <th><a href="#" data-toggle="modal" data-target="#add_prac" class="add_data_prac pull-right" style="margin-right: 5px;">添加</a></th>

                    </tr>
                  </thead>
                        <!-- 添加Modal -->
                      <div class="modal fade" id="add_prac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="exampleModalLabel">添加一条新数据</h4>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="form-group" style="height: 59px;">
                                  <div class="pull-left">
                                    <label for="message-text" class="control-label">日期:</label>
                                    <input type="text" class="form-control" placeholder="yyyy-mm-dd" aria-describedby="sizing-addon1" id="add_data_prac_date">
                                  </div>
                                  <div class="" style="width: 172px;display: inline-block;margin-left: 25px;">
                                    <label for="message-text" class="control-label">类别:</label>
                                    <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;" id="add_data_prac_kind">
                                      <option value=1 selected="selected"><a href="#">志愿者活动</a></option>
                                      <option value=2><a href="#">学生会工作</a></option>
                                      <option value=3><a href="#">社团工作</a></option>
                                    </select>
                                  </div>
                                  <div class="pull-right">
                                    <label for="message-text" class="control-label">评分:</label>
                                    <input type="text" class="form-control" placeholder="百分制" aria-describedby="sizing-addon1" id="add_data_prac_grade">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="control-label">地点:</label>
                                  <input type="text" class="form-control" id="add_data_prac_place">
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="control-label">内容:</label>
                                  <textarea class="form-control" id="add_data_prac_content"></textarea>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              <button type="button" class="btn btn-primary" data-dismiss="modal" id="add_data_prac_save">保存</button>
                            </div>
                          </div>
                        </div>
                      </div><!-- 添加Modal -->
                        <!-- 修改Modal -->
                        <div class="modal fade" id="change_prac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">添加一条新数据</h4>
                              </div>
                              <div class="modal-body">
                                <form>
                                  <div class="form-group" style="height: 59px;">
                                    <div class="pull-left">
                                      <label for="message-text" class="control-label">日期:</label>
                                      <input type="text" class="form-control" placeholder="yyyy-mm-dd" aria-describedby="sizing-addon1"  id="change_data_prac_date">
                                    </div>
                                    <div class="" style="width: 172px;display: inline-block;margin-left: 25px;">
                                      <label for="message-text" class="control-label">类别:</label>
                                      <select type="button" class="btn btn-default dropdown-toggle btn-lg course-term" id="change_data_prac_kind" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 172px;height: 34px;border-radius: 4px;font-size: 14px;">
                                        <option value=1 selected="selected"><a href="#">志愿者活动</a></option>
                                        <option value=2><a href="#">学生会工作</a></option>
                                        <option value=3><a href="#">社团工作</a></option>
                                      </select>
                                    </div>
                                    <div class="pull-right">
                                      <label for="message-text" class="control-label">评分:</label>
                                      <input type="text" class="form-control" placeholder="百分制" aria-describedby="sizing-addon1" id="change_data_prac_grade">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">地点:</label>
                                    <input type="text" class="form-control"  id="change_data_prac_place">
                                  </div>
                                  <div class="form-group">
                                    <label for="message-text" class="control-label">内容:</label>
                                    <textarea class="form-control"  id="change_data_prac_content"></textarea>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary"  data-dismiss="modal" id="change_data_prac_save">保存</button>
                              </div>
                            </div>
                          </div>
                        </div><!-- 修改Modal -->
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
          </div><!-- 右侧内容部分 社会实践 -->


        </div><!-- container-fluid -->
      </div><!-- row -->
<script type="text/javascript" src="./js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="./js/bootstrap.js"></script>
<script type="text/javascript" src="./js/teach_onload.js"></script>
<script type="text/javascript" src="./js/teach_button.js"></script>
  </body>
</html>











<tr data-id="后台传进来的数据">
  <td>1</td>
  <td>2</td>
  <td>3</td>
  <td>4</td>
  <td><a>删除</a></td>
</tr>









