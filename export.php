<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="knowledge_export.csv"');

$output = fopen('php://output', 'w');

// BOMを出力（Excel対策）
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// ヘッダー行を出力
fputcsv($output, ['ID', 'タイトル', 'Question', 'Answer', 'Reference', '作成日時', '更新日時']);

// データを出力
$stmt = $pdo->query("SELECT * FROM knowledge ORDER BY id ASC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [
        $row['id'],
        $row['title'],
        $row['question'],
        $row['answer'],
        $row['reference'],
        $row['created_at'],
        $row['updated_at']
    ]);
}

fclose($output);