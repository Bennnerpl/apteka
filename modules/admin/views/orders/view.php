<?php

use app\models\Products;
use app\modules\admin\models\OrderItems;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
    <h1><?= Html::encode($this->title) ?></h1>
<!--    <p>-->
<!--        --><?php //= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?php //= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'date',
        ],
    ]) ?>
    <?php
//    $products = OrderItems::findOne(['order_id' => $model->id]);
//    $productsItems = Products::findOne(['id' => $products->id]);
//    $products = Products::findOne(['id' => $model->id]);
    $products = Products::findAll(['id' => $model->id]);
    $productsDetail = OrderItems::findOne(['order_id' => $model->id]);
    $subtotal = 0;
    ?>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Торговое наименование</th>
            <th>Международное наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product->name ?></td>
                <td><?= $product->name_world ?></td>
                <td><?= $product->price ?></td>
                <td><?= $productsDetail->quantity ?></td>
<!--                <td class="text-right">--><?php //= $product->quantity; ?><!--</td>-->
<!--                <td class="text-right">--><?php //= $product->price; ?><!--</td>-->
<!--            </tr>-->
                <td><?= $subtotal = ($product->price * $productsDetail->quantity) ?></td>

        <tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="4" class="text-right">Итого</th>
            <th class="text-right"><?= $subtotal ?></th>
        </tr>

    </table>
<?php //print_r($products);?>
<!--    --><?php //print_r($productsDetail);?>
</div>
