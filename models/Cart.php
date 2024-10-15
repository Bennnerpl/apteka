<?php

namespace app\models;

use app\models\Products;
use Yii;
use yii\base\Model;

class Cart extends Model
{
//Добавление в корзину
    public static function addToCart($id, $quantity = 1)
    {
        $cart = Yii::$app->session->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;

        } else {
            $product = Products::findOne($id);
            if ($product) {
                $cart[$id] = [
                    'id' => $id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'summ' => $product->price * $quantity,
                ];
            }
        }
        Yii::$app->session->set('cart', $cart);

    }

//    Удаление товара из корзины
    public static function removeFromCart($id)
    {
        $cart = Yii::$app->session->get('cart', []);
        if (isset($cart)) {
            unset($cart[$id]);
        }
        Yii::$app->session->set('cart', $cart);
    }


}