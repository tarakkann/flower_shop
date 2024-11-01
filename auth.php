<?php include 'header.php'; ?>

<h1>Авторизация</h1>
<form action="login.php" method="POST">
    <label for="username">Логин:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Войти</button>
</form>

<p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a></p>

<?php include 'footer.php'; ?>
