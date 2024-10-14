<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use app\models\Users;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните поля, чтобы зарегистрироваться</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-5 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
                'action' => ['site/register'],
            ]); ?>

            <?= $form->field($model, 'fio')->textInput(['autofocus' => true])->label('Имя') ?>
            <?= $form->field($model, 'email')->textInput(['type' => 'email'])->label('Почта')  ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль')  ?>

<!--            --><?php //= $form->field($model, 'repPass')->passwordInput()->label('Повторите пароль')  ?>
            <div class="d-flex flex-row gap-2">
                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <?= Html::a('Вход', ['site/login'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
