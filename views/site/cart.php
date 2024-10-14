<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\models\Products;
use app\models\Cart;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /*table tbody tr:nth-child(2) {*/
    /*    display:none;*/
    /*}*/
</style>
<h1>Корзина</h1>
<?php $formOrder = ActiveForm::begin([
    'method' => 'post',
    'action' => ['checkout'],

])?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Цена</th>
        <th scope="col">Количество</th>
        <th scope="col">Итого</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($cart as $item ): ?>
        <?= Html::hiddenInput('id', $item['id']); ?>
        <tr id="<?= $item['id']?>">
            <th scope="row"> <?= $i++; ?></th>
            <td><?= $item['name']; ?></td>
            <td><?= $item['price']; ?></td>
            <td><?= $item['quantity']; ?></td>
            <td><?= $item['summ'] ?></td>
            <td><?= Html::a('Удалить', ['cart/remove', 'id' => $item['id']], ['class' => 'text-danger']) ?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
    <?= Html::a('Очистить корзину', ['cart/clear'], ['class' => 'btn btn-danger']) ?>
</table>
<?php if (Yii::$app->user->isGuest): ?>
    <?php echo 'Оформление заказа доступно только зарегистрированным пользователям' ?>
<?php else: ?>
    <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary']) ?>
<?php endif;?>
<?php ActiveForm::end()?>

