<?php
include("./include/common.php");
?>
<?php
{@$qq=$_GET["qq"];
if ($qq==""){echo "请输入请要查询的QQ";}

    else {
		$row=$DB->get_row("SELECT * FROM black_list WHERE qq='$qq' limit 1");
	echo '查询QQ：'.$qq.'<br>';
	if($row) {
		echo '云黑级别：'.$row['level'].'级<br>云黑时间：'.$row['date'].'<br>云黑原因：'.$row['note'].'<br>操作者：'.$row['czz'].'';
?>
<?php
	}else{
		echo '该QQ未在云端黑名单中';
	}	
}
}
$DB->close();
?>