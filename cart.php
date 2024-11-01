<?php
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Вы должны войти в систему, чтобы увидеть список покупок.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'];

    if ($action === 'update' && isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
        $sql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
        $stmt->execute();
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }
}

$sql = "SELECT products.id, products.name, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<h1>Список покупок</h1>

<div class="cart">
    <table>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Всего</th>
            <th>Действие</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php $subtotal = $row['price'] * $row['quantity']; ?>
            <?php $total += $subtotal; ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo "₽" . number_format($row['price'], 2); ?></td>
                <td>
                    <form method="post" action="cart.php" class="quantity-form">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" onchange="this.form.submit()">
                    </form>
                </td>
                <td><?php echo "₽" . number_format($subtotal, 2); ?></td>
                <td>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="delete-btn">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="3" class="total-label">Итого:</td>
            <td colspan="2" class="total-amount"><?php echo "$" . number_format($total, 2); ?></td>
        </tr>
    </table>
</div>

<?php
$stmt->close();
$conn->close();
include 'footer.php';
?>
