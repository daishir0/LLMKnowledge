<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="knowledge_export3.txt"');

$output = fopen('php://output', 'w');

// BOMを出力（Excel対策）
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// データを出力
$stmt = $pdo->query("SELECT answer FROM knowledge ORDER BY id ASC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fwrite($output, $row['answer'] . "\n\n---\n\n");
}

fclose($output);