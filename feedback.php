<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: auth.php");
    exit;
}
include 'header.php';
?>

<h1>Форма обратной связи</h1>
<form action="feedback_action.php" method="POST">
    <label for="message">Ваше сообщение:</label>
    <textarea id="message" name="message" required></textarea>
    
    <button type="submit">Отправить</button>
</form>

<?php include 'footer.php'; ?>
