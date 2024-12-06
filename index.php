<?php
require_once 'config.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ナレッジ管理システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">ナレッジ管理システム</h1>
    
    <!-- ナレッジ一覧 -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>ナレッジ一覧</h2>
            <div>
                <a href="create.php" class="btn btn-primary">新規作成</a>
                <a href="export.php" class="btn btn-success">Salesforceデータエクスポート</a>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>作成日時</th>
                    <th>更新日時</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM knowledge ORDER BY updated_at DESC");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= h($row['id']) ?></td>
                    <td><?= h($row['title']) ?></td>
                    <td><?= h($row['created_at']) ?></td>
                    <td><?= h($row['updated_at']) ?></td>
                    <td>
                        <a href="view.php?id=<?= h($row['id']) ?>" class="btn btn-sm btn-info">閲覧</a>
                        <a href="edit.php?id=<?= h($row['id']) ?>" class="btn btn-sm btn-warning">編集</a>
                        <a href="delete.php?id=<?= h($row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')">削除</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>