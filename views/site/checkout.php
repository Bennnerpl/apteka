<?php

use app\models\Users;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\models\Products;
use app\models\Cart;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\Users $users */
//$users = Users::$fio;
?>

<div class="col-sm-9">
    <h1>Оформление заказа</h1>
    <?php $formOrder = ActiveForm::begin([
            'id' => 'form-order',
        'method' => 'post',
        'action' => ['site/order'],

    ])?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
            <th scope="col">Итого</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        $cart = Yii::$app->session['cart'];
        ?>
        <?php foreach ($cart as $item ): ?>
            <tr id="<?= $item['id']?>">
                <th scope="row"> <?= $i++; ?></th>
                <td><?= $item['name']; ?></td>
                <td><?= $item['price']; ?></td>
                <td><?= $item['quantity']; ?></td>
                <td><?= $item['summ'] ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<!--    --><?php //= $formOrder->field($users, 'fio')->textInput(['autofocus' => true])->label('Имя') ?>
    <?= Html::submitButton('Оформить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end()?>
</div>
<?php //print_r($cart) ?>