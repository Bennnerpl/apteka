<?php

namespace app\controllers;

use app\models\Orders;
use app\models\OrderItems;
use yii;
use yii\web\Controller;

class OrderController extends Controller
{
//    public function actionCheckout()
//    {
//        $order = new Orders();
//        $orderItems = Yii::$app->request->post('orderItems'); // Ваш массив с товарами
//
//        if ($order->load(Yii::$app->request->post())) {
//            $order->user_id = Yii::$app->user->id; // Заполняем user_id текущим пользователем
//            $order->date = date('Y-m-d H:i:s'); // Свежая дата заказа
//
//            if ($order->save()) {
//                foreach ($orderItems as $item) {
//                    $orderItem = new OrderItems();
//                    $orderItem->order_id = $order->id;
//                    $orderItem->order_product_id = $item['product_id']; // Предположим, что вы получаете product_id
//                    $orderItem->quantity = $item['quantity'];
////                    $orderItem->price = $item['price'];
//                    $orderItem->save(); // Вы можете добавить проверку на успешное сохранение
//                }
//                return $this->redirect(['view', 'id' => $order->id]); // Перенаправление на страницу просмотра заказа
//            }
//        }
//
//        return $this->render('checkout', [
//            'model' => $order,
//        ]);
//    }

}