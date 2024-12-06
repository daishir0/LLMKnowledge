<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="knowledge_export2.csv"');

$output = fopen('php://output', 'w');

// BOMを出力（Excel対策）
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// ヘッダー行を出力
fputcsv($output, ['Question', 'Answer']);

// データを出力
$stmt = $pdo->query("SELECT question, answer, reference FROM knowledge ORDER BY id ASC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // answer と reference を結合
    $combined_answer = $row['answer'];
    if (!empty($row['reference'])) {
        $combined_answer .= "\n\n参考資料：\n" . $row['reference'];
    }
    
    fputcsv($output, [
        $row['question'],
        $combined_answer
    ]);
}

fclose($output);