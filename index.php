<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<h1>Добро пожаловать в Магазин цветов!</h1>
<p>Мы предлагаем цветы для любого случая. Ознакомьтесь с нашей продукцией!</p>

<h2>Популярные товары</h2>

<div class="slideshow-container">
    <?php
    $sql = "SELECT * FROM products LIMIT 5";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div class='mySlides fade'>";
        echo "<img src='assets/" . $row['image'] . "' style='width:100%; height:300px;'>";
        echo "<div class='text'>" . $row['name'] . " - ₽" . $row['price'] . "</div>";
        echo "</div>";
    }
    ?>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<div style="text-align:center">
    <?php
    for ($i = 1; $i <= $result->num_rows; $i++) {
        echo "<span class='dot' onclick='currentSlide($i)'></span>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
<script src="script.js"></script>
