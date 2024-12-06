<?php
require_once 'config.php';
require_once 'functions.php';

$stmt = $pdo->prepare("SELECT * FROM knowledge WHERE id = :id");
$stmt->execute([':id' => $_GET['id']]);
$knowledge = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$knowledge) {
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($knowledge['title']) ?> - ナレッジ閲覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4"><?= h($knowledge['title']) ?></h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Question</h5>
            <p class="card-text"><?= nl2br(h($knowledge['question'])) ?></p>
            
            <h5 class="card-title">Answer</h5>
            <p class="card-text"><?= nl2br(h($knowledge['answer'])) ?></p>
            
            <?php if ($knowledge['reference']): ?>
            <h5 class="card-title">Reference</h5>
            <a href="<?= h($knowledge['reference']) ?>" target="_blank" rel="noopener noreferrer"><?= h($knowledge['reference']) ?></a>
            <?php endif; ?>
        </div>
    </div>
    
    <div>
        <a href="index.php" class="btn btn-secondary">戻る</a>
        <a href="edit.php?id=<?= h($knowledge['id']) ?>" class="btn btn-warning">編集</a>
    </div>
</body>
</html>