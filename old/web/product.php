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
$productIDPG = $pdo->prepare("SELECT * FROM products
JOIN uses_reccommend ON products.indications_id=uses_reccommend.id
JOIN using_reccomends ON products.indications_id=using_reccomends.id
JOIN releases ON products.form_id=releases.id
JOIN release_forms ON products.form_id=release_forms.id
JOIN dosages ON products.dosage_id=dosages.id
WHERE products.id = ?
");
$productIDPG->execute([$_GET['id']]);
$product = $productIDPG->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<?php require("header.php") ?>
<style>
    .product-page section.py-2 {
        display: none;
    }
</style>
<body class="product-page" >
<?php  if($_GET['page'] == 'product') :?>
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="woocommerce-placeholder.png" id="product-detail">
                    </div>
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?=$product['name'] ?></h1>
                            <p class="h3 py-2"><?=$product['price'] ?> руб</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Мировое название:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?=$product['name_world'] ?></strong></p>
                                </li>
                            </ul>
                            <h6>Показания к применению:</h6>
                            <p><?=$product['name_reccommendation']?></p>
                            <h6>Характеристики:</h6>
                            <ul class="list-unstyled pb-3">
                                <li>Форма выпуска
                                    <?=$product['name_release']?>
                                </li>
                                <li>Дозировка
                                    <?=$product['dosage']?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
<?php require("footer.php") ?>
</body>
</html>



