<?php
include 'header.php';
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<h1>Каталог товаров</h1>

<div class="product-table">
    <table>
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <img src="assets/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="product-image">
                    </td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo number_format($row['price'], 2); ?> ₽</td>
                    <td>
                        <a href="product.php?id=<?php echo $row['id']; ?>" class="btn">Подробнее</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>
