<?php
/**
 * li1023 网站版本控制文件
 * 
 * 用于管理网站版本和资源缓存控制
 */

// 网站版本信息
$version = [
    'major' => 1,      // 主版本号 - 重大更新
    'minor' => 0,      // 次版本号 - 功能更新
    'patch' => 2,      // 补丁版本 - 错误修复
    'build' => date('Ymd'), // 构建日期
    'timestamp' => time() // 时间戳，用于缓存控制
];

// 返回完整版本号
function getFullVersion() {
    global $version;
    return $version['major'] . '.' . $version['minor'] . '.' . $version['patch'];
}

// 返回带时间戳的资源版本号（用于缓存控制）
function getResourceVersion() {
    global $version;
    return getFullVersion() . '.' . $version['timestamp'];
}

// 如果直接访问此文件，输出版本信息
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    header('Content-Type: application/json');
    echo json_encode([
        'name' => 'li1023',
        'version' => getFullVersion(),
        'build' => $version['build'],
        'updated' => date('Y-m-d H:i:s', $version['timestamp'])
    ]);
}

// 在HTML中使用此版本号的示例
// <link rel="stylesheet" href="styles.css?v=<?php echo getResourceVersion(); ?>">
// <script src="script.js?v=<?php echo getResourceVersion(); ?>" defer></script>
?> 