<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин цветов</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <a href="index.php">
                <img src="assets/logo.png" alt="Логотип магазина">
            </a>
            <span>Магазин цветов</span>
        </div>
        <nav>
            <a href="index.php">Главная</a>
            <a href="store.php">Магазин</a>
            <?php if (isset($_SESSION['logged_in'])): ?>
                <a href="cart.php" class="header-btn">Корзина</a>
                <a href="feedback.php" class="header-btn">Обратная связь</a>
                <a href="logout.php" class="header-btn">Выйти</a>
            <?php else: ?>
                <a href="auth.php" class="header-btn">Войти</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
