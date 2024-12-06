<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO knowledge (title, question, answer, reference)
        VALUES (:title, :question, :answer, :reference)
    ");
    
    $stmt->execute([
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
    <title>ナレッジ新規作成</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">ナレッジ新規作成</h1>
    
    <form method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <textarea class="form-control" id="answer" name="answer" rows="5" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="reference" class="form-label">Reference (URL)</label>
            <input type="url" class="form-control" id="reference" name="reference">
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">保存</button>
            <a href="index.php" class="btn btn-secondary">キャンセル</a>
        </div>
    </form>
</body>
</html>