<?php

//decode by http://www.yunlu99.com/
error_reporting(E_ALL & ~E_NOTICE);
@header('Content-Type: text/html; charset=UTF-8');
if (file_exists('install.lock')) {
	exit('<center><img border="0" width="480" src="../images/2.gif" /><br><br><strong><font size="6" color="red">云黑系统已经安装完成！</font></strong><br>如需重装，请删除install目录下的install.lock!</center>');
}
$step = is_numeric($_GET['step']) ? $_GET['step'] : '1';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
	<title>kyle云黑数据库配置</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="./assets/css/css/font-awesome.min.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>云黑数据库配置</a>
    </div>
  </div>
</nav>

<div class="container">
	<div class="row"><br>
	<?php 
if ($step == 1) {
	?>
		<div class="col-xs-12">
			<div class="list-group">
				<div class="list-group-item list-group-item-info">欢迎使用kyle云黑系统！！</div>
				<div class="list-group-item">
					1、此云黑系统为kyle优化修改版
				</div>
				<div class="list-group-item list-group-item-warning">
					2、本程序完全免费开源请勿随意修改倒卖
				</div>
				<div class="list-group-item">
					3、感谢您的使用！
				</div>
				<div class="list-group-item">
					<a href="?step=2" class="btn btn-block btn-warning">同意以上，进行下一步</a>
				</div>
			</div>

		</div>
	<?php 
} elseif ($step == 2) {
	?>
		<div class="col-xs-12">
			<div class="list-group">
				<div class="list-group-item list-group-item-success">数据库配置</div>
			<form action="?step=3" role="form" class="form-horizontal" method="post">
			<div class="list-group-item">
				<div class="input-group">
					<div class="input-group-addon">数据库地址</div>
					<input type="text" class="form-control" name="DB_HOST" value="localhost">
				</div>
			</div>
			<div class="list-group-item">
				<div class="input-group">
					<div class="input-group-addon">数据库端口</div>
					<input type="text" class="form-control" name="DB_PORT" value="3306">
				</div>
			</div>
			<div class="list-group-item">
				<div class="input-group">
					<div class="input-group-addon">数据库库名</div>
					<input type="text" class="form-control" name="DB_NAME" placeholder="输入数据库库名">
				</div>
			</div>
			<div class="list-group-item">
				<div class="input-group">
					<div class="input-group-addon">数据用户名</div>
					<input type="text" class="form-control" name="DB_USER" placeholder="输入数据库用户名">
				</div>
			</div>
			<div class="list-group-item">
				<div class="input-group">
					<div class="input-group-addon">数据库密码</div>
					<input type="text" class="form-control" name="DB_PWD" placeholder="输入数据库密码">
				</div>
			</div>
			<div class="list-group-item">
				<input type="submit" name="submit" value="保存配置" class="btn btn-primary btn-block">
			</div>
			</form>
				
			</div>
		</div>
	<?php 
} elseif ($step == 3) {
	if (!$_POST['DB_HOST'] || !$_POST['DB_PORT'] || !$_POST['DB_NAME'] || !$_POST['DB_USER'] || !$_POST['DB_PWD']) {
		exit('<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>');
	}
	if (!($con = mysqli_connect($_POST['DB_HOST'], $_POST['DB_USER'], $_POST['DB_PWD'], $_POST['DB_NAME'], $_POST['DB_PORT']))) {
		exit('<script language=\'javascript\'>alert("连接数据库失败，' . mysqli_error() . '");history.go(-1);</script>');
	} elseif (!mysqli_select_db($con, $_POST['DB_NAME'])) {
		exit('<script language=\'javascript\'>alert("选择的数据库不存在，' . mysqli_error() . '");history.go(-1);</script>');
	}
	$a = $_POST['DB_HOST'];
	//
	$b = $_POST['DB_PORT'];
	//
	$c = $_POST['DB_USER'];
	//
	$d = $_POST['DB_PWD'];
	//
	$e = $_POST['DB_NAME'];
	//
	$aa = '$host = "' . $a . '";';
	$bb = '$port = "' . $b . '";';
	$cc = '$user = "' . $c . '";';
	$dd = '$pwd = "' . $d . '";';
	$ee = '$dbname = "' . $e . '";';
	$nr = '<?php 
' . $aa . $bb . $cc . $dd . $ee . ';?>';
	$fp = fopen('../config.php', 'w');
	fwrite($fp, $nr);
	?>
		<div class="col-xs-12">
			<div class="list-group">
				<div class="list-group-item list-group-item-info">数据库配置文件保存成功</div>
				<div class="list-group-item">
					<a href="?step=4" onclick="if(!confirm('创建数据表会清空已存在的，是否继续？')){return false;}" class="btn btn-block btn-warning">创建数据表</a>
				</div>
				<div class="list-group-item">
					<a href="?step=5" class="btn btn-block btn-warning">我已有完整数据，跳过创建！</a>
				</div>
			</div>
		</div>
	<?php 
} elseif ($step == 4) {
	require_once "../config.php";
	try {
		$db = new PDO("mysql:host=" . $host . ";dbname=" . $dbname . ";port=" . $port, $user, $pwd);
	} catch (Exception $e) {
		exit('链接数据库失败:' . $e->getMessage());
	}
	$db->exec("set names utf8");
	$sqls = @file_get_contents("install.sql");
	$explode = explode("<fgf>", $sqls);
	$num = count($explode);
	foreach ($explode as $sql) {
		if ($sql = trim($sql)) {
			$db->exec($sql);
		}
	}
	if (mysqli_error()) {
		exit('<script language=\'javascript\'>alert("导入数据表时错误，' . mysqli_error() . '");history.go(-1);</script>');
	}
	exit("<script language='javascript'>alert('执行SQL成功，共导入{$num}条数据!');window.location.href='?step=5';</script>");
} elseif ($step == 5) {
	@file_put_contents('install.lock', '安装锁定文件');
	?>
		<div class="col-xs-12">
			<div class="list-group">
				<div class="list-group-item list-group-item-info">kyle云黑系统安装完成！</div>
				<div class="list-group-item">
					<a href="../index.php" class="btn btn-block btn-success" target="_blank">进入云黑首页</a>
				</div>
				<div class="list-group-item">
					<a href="/siteadmin" class="btn btn-block btn-warning" target="_blank">进入云黑后台（默认账号密码：admin/admin）</a>
				</div>
			</div>
		</div>
	<?php 
}
?>
	</div>
</div>	
</div>

<script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.bootcss.com/layer/3.0.1/layer.min.js"></script>

</body>
</html>