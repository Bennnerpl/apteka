<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Breadcrumbs;
use app\widgets\Alert;
?>

    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="woocommerce-placeholder.png" alt="">
                    <div class="card-body text-center">
                        <a href="<?= Url::to(['product', 'id' => $model['id']]); ?>" class="h4 text-primary text-decoration-none"><?php echo Html::encode($model->name) ?></a>
<!--                      <p class="h4 text-primary text-decoration-none">--><?php //echo Html::encode($model->name_world) ?><!--</p>-->
                        <div class="product-price">
                                <span class="text-muted">Цена <?php echo Html::encode($model->price) ?></span>
                        </div>
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['cart/add'],

                        ])?>
                       <?= Html::hiddenInput('id', $model['id']); ?>
                        <div class="quantity">
                            <button type="button" class="plus">+</button>
                            <?= Html::input('number', 'quantity', 1 , ['min' => 1, 'max' => '12' , 'step' => '1']) ?>
                            <button type="button" class="minus">-</button></div>
                        <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end()?>
                    </div>
                </div>
            </div>

        </div>
    </div>
<style>
    .quantity {
    display: flex;
    }
    .quantity button {
        font-size: 24px;
        outline: none;
        border: none;
    }
   .quantity input[type="number"] {
        width: 100%;
        text-align: center;
        background: transparent !important;
        transition: all .3s ease;
        color: #111111;
        -moz-appearance: none;
       appearance: none;
       outline: none;
       border: none;
    }
</style>

