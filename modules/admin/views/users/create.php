<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\UsersSearch $model */

$this->title = Yii::t('app', 'Список пользователей');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список пользователей'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-search-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>