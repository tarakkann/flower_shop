<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Вы должны войти в систему, чтобы добавить товар в корзину.";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id']; 

if (empty($product_id)) {
    echo "Некорректный запрос.";
    exit;
}

$sql_check = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
} else {
    $sql_insert = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
}

$stmt->close();
$conn->close();

header("Location: cart.php");
exit;
?>
