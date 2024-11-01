<?php
include 'db.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql_check = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
} else {
    $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        header("Location: auth.php");
        echo "Ошибка регистрации. Попробуйте снова.";
    }
}

$stmt->close();
$conn->close();
?>
