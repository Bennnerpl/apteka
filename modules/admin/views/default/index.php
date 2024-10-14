<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\models\Products;
use app\models\Cart;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Административная панель';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index d-flex flex-column w-25 gap-3">
    <h1>Административная панель</h1>
    <h3>Просмотреть\редактировать\добавить пользователей</h3>
    <?= Html::a('Список пользователей', ['users/index'], ['class' => 'btn btn-primary']) ?>
    <h3>Просмотр заказов</h3>
    <?= Html::a('Список заказов', ['orders/index'], ['class' => 'btn btn-primary']) ?>

</div>