<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Products;
use yii\widgets\ListView;
use yii\bootstrap5\Breadcrumbs;
use app\widgets\Alert;
$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
/* @var $model Products */
/* @var $provider  */
?>

        <?php

        echo ListView::widget([
            'dataProvider' => $provider,
            'itemView' => '_products',
            'options' => [
                    'tag' => 'div',
                'class' => 'row row-cols-1 row-cols-sm-4 g-3',

            ],
            'summary' => '',
        ]);
        ?>
<script>
    jQuery(document).ready(function ($) {
        $( 'body' ).on( 'click', 'button.plus, button.minus', function() {

            var qty = $(this).parent().find( 'input' ),
                val = parseInt( qty.val() ),
                min = parseInt( qty.attr( 'min' ) ),
                max = parseInt( qty.attr( 'max' ) ),
                step = parseInt( qty.attr( 'step' ) );

            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( max <= val ) ) {
                    qty.val( max );
                } else {
                    qty.val( val + step );
                }
            } else {
                if ( min && ( min >= val ) ) {
                    qty.val( min );
                } else if ( val > 1 ) {
                    qty.val( val - step );
                }
            }
            qty.trigger( 'change' );
            console.log(qty);
        });
    })

</script>