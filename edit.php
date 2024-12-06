<?php
require_once 'config.php';
require_once 'functions.php';

$stmt = $pdo->prepare("SELECT * FROM knowledge WHERE id = :id");
$stmt->execute([':id' => $_GET['id']]);
$knowledge = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$knowledge) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        UPDATE knowledge 
        SET title = :title,
            question = :question,
            answer = :answer,
            reference = :reference,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = :id
    ");
    
    $stmt->execute([
        ':id' => $_GET['id'],
        ':title' => $_POST['title'],
        ':question' => $_POST['question'],
        ':answer' => $_POST['answer'],
        ':reference' => $_POST['reference']
    ]);
    
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($knowledge['title']) ?> - ナレッジ編集</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">ナレッジ編集</h1>
    
    <form method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= h($knowledge['title']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question" rows="3" required><?= h($knowledge['question']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <textarea class="form-control" id="answer" name="answer" rows="5" required><?= h($knowledge['answer']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="reference" class="form-label">Reference (URL)</label>
            <input type="url" class="form-control" id="reference" name="reference" value="<?= h($knowledge['reference']) ?>">
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">更新</button>
            <a href="index.php" class="btn btn-secondary">キャンセル</a>
        </div>
    </form>
</body>
</html>