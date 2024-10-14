<?php
namespace app\controllers;

use app\models\Products;
use app\models\Cart;
use yii;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller {
    //Добавление в корзину
   public function actionAdd() {
      $id = Yii::$app->request->post('id');
       $quantity = Yii::$app->request->post('quantity');
       Cart::addToCart($id, $quantity);
       return $this->redirect(['site/cart']);
   }
    //    Удаление товара из корзины
    public function actionRemove() {
       $id = Yii::$app->request->get('id');
        Cart::removeFromCart($id);
        return $this->redirect(['site/cart']);
    }
    public function actionClear() {
        Yii::$app->session->remove('cart');
        return $this->redirect(['site/cart']);
    }
    public function actionCheckout() {
        $id = Yii::$app->request->post('id');
        $quantity = Yii::$app->request->post('quantity');
       return $this->render('site/checkout');
    }
}