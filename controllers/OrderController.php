<?php

namespace app\controllers;

use app\models\Products;
use app\models\Orders;
use app\models\OrderItems;
use yii;
use yii\db\Exception;
use yii\web\Controller;

class OrderController extends Controller
{

    /**
     * @throws Exception
     */
    public function actionOrder()
    {
        $model = new Orders();
//        $modelItems = new OrderItems();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            Yii::$app->getSession()->setFlash('success');
            return $this->redirect(['index']);
        } else {
            return $this->render('checkout', [
                'model' => $model,
            ]);
        }
    }

}