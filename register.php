<?php include 'header.php'; ?>

<h1>Регистрация</h1>
<form action="register_action.php" method="POST">
    <label for="username">Логин:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Зарегистрироваться</button>
</form>

<?php include 'footer.php'; ?>
