<?php

use app\modules\admin\models\UsersSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Список пользователей');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Административная панель'), 'url' => ['/admin/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-search-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать пользователя'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fio',
            'email:email',
            'password',
            [
                    'attribute' => 'role',
                    'label' => 'Роль',
                    'value' => function ($model) {
                        return $model->role == 2 ? 'Администратор' : 'Пользователь';
                    }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UsersSearch $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>