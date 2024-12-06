<?php
$db_path = __DIR__ . '/knowledge.db';
$pdo = new PDO("sqlite:$db_path");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// データベース初期化
$pdo->exec("
    CREATE TABLE IF NOT EXISTS knowledge (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        question TEXT NOT NULL,
        answer TEXT NOT NULL,
        reference TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");