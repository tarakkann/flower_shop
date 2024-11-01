<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Вы должны войти в систему, чтобы отправить сообщение.";
    exit;
}

$user_id = $_SESSION['user_id'];
$message = $_POST['message']; 

if (empty($message)) {
    echo "Сообщение не может быть пустым.";
    exit;
}

$sql = "INSERT INTO feedback (user_id, message) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $message);

if ($stmt->execute()) {
    echo "Спасибо за ваше сообщение!";
} else {
    echo "Ошибка при отправке сообщения. Попробуйте снова.";
}

$stmt->close();
$conn->close();
exit;
?>
