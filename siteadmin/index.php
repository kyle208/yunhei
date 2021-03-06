<?php
/**
 * 云黑查询系统后台
**/
$mod='blank';
include("../include/common.php");
$title='云黑查询系统后台';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">云黑查询系统后台</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
		<li>
            <a href="../" target="view_window"><span class="glyphicon glyphicon-user"></span> 云黑首页</a>
          </li>
          <li class="active">
            <a href="./"><span class="glyphicon glyphicon-user"></span> 后台首页</a>
          </li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 云黑管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./add.php">添加云黑</a><li>
			  <li><a href="./list.php">云黑列表</a></li>
			  <li><a href="./search.php">搜索云黑</a><li>
            </ul>
          </li>
		  <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> 系统管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./siteset.php">全局设置</a><li>
			  <li><a href="./passwd.php">修改密码</a></li>
            </ul>
          </li>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-off"></span> 退出管理</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
<?php
$sum=$DB->count("SELECT count(*) from black_list WHERE 1");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">后台首页</h3></div>
          <ul class="list-group">
            <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>后台统计：</b> 共:<?=$sum?>个云黑用户</li>
            <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b> <?=$date?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>欢迎你：</b> 超级管理员</li>
            <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>功能菜单：</b> 
              <a href="./add.php" class="btn btn-xs btn-success">添加云黑</a>
			  <a href="./list.php" class="btn btn-xs btn-success">云黑修改</a>
			  <a href="./siteset.php" class="btn btn-xs btn-success">全局设置</a>
			  <a href="./passwd.php" class="btn btn-xs btn-success">修改密码</a>
            </li>
          </ul>
      </div>
    </div>
  </div>