<?php
/**
 * 修改
**/
$mod='blank';
include("../include/common.php");
$title='修改';
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
          <li>
            <a href="./"><span class="glyphicon glyphicon-user"></span> 后台首页</a>
          </li>
          <li class="active">
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
              <li><a href="./siteset.php">站点设置</a><li>
			  <li><a href="./passwd.php">修改密码</a></li>
            </ul>
          </li>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-off"></span> 退出登陆</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
if($_GET['my']=='update') {
$id=intval($_GET['id']);
$row=$DB->get_row("SELECT * FROM black_list WHERE id='{$id}' limit 1");
if($row=='')exit("<script language='javascript'>alert('后台不存在该云黑用户！');history.go(-1);</script>");
if(isset($_POST['submit'])) {
	$qq=daddslashes($_POST['qq']);
	$level=daddslashes($_POST['level']);
	$note=daddslashes($_POST['note']);
	$czz=daddslashes($_POST['czz']);
		$sql="update `black_list` set `qq` ='{$qq}',`level` ='{$level}',`note` ='{$note}',`czz` ='{$czz}'  where `id`='{$id}'";
	if($DB->query($sql)){
		showmsg('修改成功！',1,$_POST['backurl']);
	}
	else showmsg('修改失败！<br/>'.$DB->error(),4,$_POST['backurl']);
}else{
?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">修改</h3></div>
        <div class="panel-body">
          <form action="./edit.php?my=update&id=<?php echo $id; ?>" method="post" class="form-horizontal" role="form">
		  <input type="hidden" name="backurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>"/>
			<div class="form-group">
              <label class="col-sm-2 control-label">QQ号/微信ID</label>
              <div class="col-sm-10"><input type="text" name="qq" value="<?php echo $row['qq']; ?>" class="form-control" required/></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">云黑等级</label>
              <div class="col-sm-10"><select name="level" class="form-control">
				<?php if($row['level']==1){?>
                <option value="1">1级-低</option>
                <option value="2">2级-中</option>
				<option value="3">3级-高</option>
				<?php }elseif($row['level']==2){?>
                <option value="2">2级-中</option>
                <option value="1">1级-低</option>
				<option value="3">3级-高</option>
				<?php }elseif($row['level']==3){?>
				<option value="3">3级-高</option>
                <option value="1">1级-低</option>
                <option value="2">2级-中</option>
				<?php }?>
              </select></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">拉黑原因</label>
              <div class="col-sm-10"><input type="text" name="note" value="<?php echo $row['note']; ?>" class="form-control"/></div>
            </div><br/>
			<div class="form-group">
              <label class="col-sm-2 control-label">操作者</label>
              <div class="col-sm-10"><input type="text" name="czz" value="<?php echo $row['czz']; ?>" class="form-control"/></div>
            </div><br/>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
			  <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">返回云黑列表</a></div>
            </div>
          </form>
        </div>
      </div>
<?php
}
}elseif($_GET['my']=='del'){
	$id=intval($_GET['id']);
	$sql="DELETE FROM black_list WHERE id='$id' limit 1";
	if($DB->query($sql)){
		showmsg('删除成功！',1,$_SERVER['HTTP_REFERER']);
	}
	else showmsg('删除失败！<br/>'.$DB->error(),4,$_SERVER['HTTP_REFERER']);
}?>

    </div>
  </div>