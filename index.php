<?php
include("./include/common.php");
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title><?php echo $sitename;?></title>
	<meta name="keywords" content="<?php echo $keywords;?>"/>
	<meta name="description" content="<?php echo $description;?>"/>
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>

	body{
		margin: 0 auto;
		text-align: center;
	}
	.container {
	  max-width: 580px;
	  padding: 15px;
	  margin: 0 auto;
	}
	</style>
	<script language="javascript">
     var t = null;
    t = setTimeout(time,1000);//开始执行
    function time()
    {
       clearTimeout(t);//清除定时器
       dt = new Date();
		var y=dt.getYear()+1900;
		var mm=dt.getMonth()+1;
		var d=dt.getDate();
		var weekday=["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
		var day=dt.getDay();
        var h=dt.getHours();
        var m=dt.getMinutes();
        var s=dt.getSeconds();
		if(h<10){h="0"+h;}
		if(m<10){m="0"+m;}
		if(s<10){s="0"+s;}
        document.getElementById("timeShow").innerHTML =  y+"年"+mm+"月"+d+"日"+""+h+":"+m+":"+s+"【"+weekday[day]+"】";
        t = setTimeout(time,1000); //设定定时器，循环执行           
    }
  </script>
</head>
<?php
$str = "123456789abcd";
$bj .= $str[mt_rand(0, strlen($str)-1)];
?>
<body background="./images/bj/bj-<?php echo $bj;?>.jpg">
<div class="container">    <div class="header">
        <ul class="nav nav-pills pull-right" role="tablist">
		  <li role="presentation" class="active"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $guanliqq; ?>" target="_blank" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-erase"></span> 举报</a></li>
        </ul>
        <h3 class="text-muted" align="left"><font color="#8968CD"><?php echo $sitename?></font></h3>
     </div><hr>
	 <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">公告栏</h3></div>
		<ul class="list-group">
		<li class="list-group-item"><?php echo $gonggao1; ?></li>
		<li class="list-group-item"><?php echo $gonggao2; ?></li>
<li class="list-group-item"><?php echo $gonggao3; ?></li>
</p><p></p><b><a class="btn btn-block btn-danger" data-toggle="collapse" data-parent="#accordion2" href="#faq1" aria-expanded="false">说明</a></b><div id="faq1" class="accordion-body collapse" style="height: 0px;" aria-expanded="false"><h5><?php echo $shuoming;?><p></p></h5></div><p></p>
</marquee></a>
<p class="bg-primary" style="background-color:#FF9900;padding: 3px;"><img border="0" width="32" src="./images/1.gif" />如果是被他人恶意举报，QQ被恶意收录，请联系解除</p
<ul class="list-group">
	
  <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b><div id="timeShow" class="time1"></div></li>
		</ul>
      </div>
	 <h3 class="form-signin-heading">输入QQ查询</h3>
	 <form action="" class="form-sign" method="post">
	 <input type="text" class="form-control" name="qq" placeholder="请输入查询QQ" value=""><br>
	 <input type="submit" class="btn btn-primary btn-block" value="点击查询"><br/>
	 <p style="text-align:left">
<?php
if($qq=$_POST['qq']) {
	$qq=$_POST['qq'];
	$row=$DB->get_row("SELECT * FROM black_list WHERE qq='$qq' limit 1");
	echo '<label>查询QQ：'.$qq.'</label><br>';
	if($row) {
		echo '
		<label>黑名单等级：</label>
		<font color="blue">'.$row['level'].'级</font><br>
		<label>黑名单时间：</label>
		<font color="blue">'.$row['date'].'</font><br>
		<label>黑名单原因：</label>
		<font color="blue">'.$row['note'].'</font><br>
	    <label><font color="red">请停止任何交易！或点举报联系解除</font></label>';
?>
<?php
	}else{
		echo '<label><font color="green">该QQ尚未被录入！但是我们不能保证交易绝对安全</font></label>';
	}
}
$DB->close();
?>
	 </p><hr><div class="container-fluid">
  
  
</div>
<p style="text-align:center">
</p></div>
</body>
</html>