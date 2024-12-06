<?php
require_once 'config.php';
require_once 'functions.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM knowledge WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}

redirect('index.php');