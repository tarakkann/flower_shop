<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="product-details">
    <div class="product-image">
        <img src="assets/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
    </div>
    <div class="product-info">
        <h1><?php echo $row['name']; ?></h1>
        <p class="description">Описание: <?php echo $row['description']; ?></p>
        <p class="price">Цена: <?php echo number_format($row['price'], 2); ?> ₽</p>
        <p class="availability">В наличии: <?php echo $row['quantity']; ?> шт.</p>
        
        <?php if (isset($_SESSION['logged_in'])): ?>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="btn-add-to-cart">Добавить в корзину</button>
            </form>
        <?php else: ?>
            <p>Для добавления товара в корзину, пожалуйста, <a href="auth.php">войдите в систему</a>.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
