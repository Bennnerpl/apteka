<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['site/products']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
                        <h1 class="h2"><?php echo Html::encode($product->name) ?></h1>
                        <p class="h3 py-2"><?php echo Html::encode($product->price) ?> руб</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Мировое название:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?php echo Html::encode($product->name_world) ?></strong></p>
                            </li>
                        </ul>
                        <h6>Показания к применению:</h6>
                        <p><?php echo Html::encode($product->indications->reccomend->name_reccommendation) ?></p>
                        <h6>Характеристики:</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Форма выпуска
                                <?php echo Html::encode($product->form->releaseForm->name_release) ?>
                            </li>
                            <li>Дозировка
                                <?php echo Html::encode($product->dosage->dosage) ?>
                            </li>
                        </ul>
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['cart/add'],

                        ])?>
                        <?= Html::hiddenInput('id', $product->id); ?>
                        <?= Html::hiddenInput('quantity', 1) ?>
                        <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end()?>
<!--                        --><?php //= Html::a('Добавить в корзину', ['cart/add', 'id' => $product->id]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>