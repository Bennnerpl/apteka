<!doctype html>
<?php
$servername = "database";
$username = "data";
$password = "asd_123";
$dbname = "data";
$port = "3306";
$charset = "utf8";
$dsn = "mysql:host=$servername;port=$port; dbname=$dbname;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $username, $password, $opt);

$prodMin = $pdo->query("SELECT name, min(price) as min_price FROM products GROUP BY name HAVING COUNT(*)>1");
$prodMinArr = $prodMin->fetchAll();
$prodSingle = $pdo->query("SELECT id,name,price FROM products GROUP BY id,name,price HAVING COUNT(*)=1");
$prodSingleArr = $prodSingle->fetchAll();
$prodArrMerge = array_merge($prodMinArr,$prodSingleArr);
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';
$title = "Товары";
?>
<html lang="en">
<?php require("header.php") ?>
<body>
<section class="py-2">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            foreach ($prodArrMerge as $product)
            {
                ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="woocommerce-placeholder.png" alt="...">
                    <div class="card-body text-center">
                        <a href="/index?page=product&id=<?=$product['id']?>" class="h4 text-primary text-decoration-none"><?= $product['name'] ?></a>
                        <div class="product-price">
                            <?php
                            if ($product['min_price']) {
                                ?>
                                <span class="text-muted">Цена от <?= $product['min_price'] ?></span>
                                <?php
                            } else {
                                ?>
                                <span class="text-muted">Цена <?= $product['price'] ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php require("footer.php") ?>
</body>
</html>
