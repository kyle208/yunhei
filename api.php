<?php
error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: application/json; charset=utf-8');

// 检查安装锁
if (!file_exists('install/install.lock')) {
    http_response_code(500);
    die(json_encode([
        'code' => 500,
        'msg' => '系统未安装，请先完成安装'
    ]));
}

include("./include/common.php");
// 获取请求参数
$input = json_decode(file_get_contents('php://input'), true) ?: $_REQUEST;
$qq = isset($input['id']) ? trim($input['id']) : '';

// 参数验证
if (empty($qq)) {
    http_response_code(400);
    die(json_encode([
        'code' => 400,
        'msg' => '缺少必要参数：id'
    ]));
}

// 查询数据库
$result = [];
$query = $DB->query("SELECT * FROM black_list WHERE qq = '$qq' LIMIT 1");
if ($row = $query->fetch_assoc()) {
    $result = [
        'code' => 200,
        'data' => [
            'id' => $row['qq'],
            'level' => (int)$row['level'],
            'date' => $row['date'],
            'note' => $row['note'],
            'czz' => $row['czz'],
            'status' => '请停止任何交易！'
        ]
    ];
} else {
    $result = [
        'code' => -1,
        'msg' => '该ID尚未被录入'
    ];
}

// 关闭数据库连接
$DB->close();

// 输出结果
echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>