<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\UsersSearch $model */

$this->title = Yii::t('app', 'Обновить данные пользователя: {name}', [
    'name' => $model->fio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список пользователей'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->fio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Обновить');
?>
<div class="users-search-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>