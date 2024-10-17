<?php

namespace app\controllers;

use app\models\OrderItems;
use app\models\Orders;
use app\models\RegisterForm;
use app\models\Users;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;
use yii\data\ActiveDataProvider;

class SiteController extends Controller

{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionProducts()
    {
        $query = Products::find();
        $provider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
              'pageSize' => 10,
          ],

      ]);
        return $this->render('products', ['provider' => $provider]);
    }

    public function actionProduct($id)
    {
        $product = Products::findOne($id);
        return $this->render('product', ['product' => $product]);

    }

    public function actionCart()
    {
        $cart = Yii::$app->session->get('cart', []);
        return $this->render('cart', ['cart' => $cart]);
    }

    /**
     * registration action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => 'ru-RU',
        ]));
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->registration()) {
            return $this->goBack();

        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }

    public function actionCheckout()
    {
        $model = new Orders();
        $orderItems = Yii::$app->session->get('cart', []); // Получаем корзину из сессии

        if (Yii::$app->request->isPost) {
            $model->user_id = Yii::$app->user->id; // Устанавливаем id пользователя
            $model->date = date('Y-m-d H:i:s'); // Устанавливаем дату заказа

            if ($model->save()) {
                foreach ($orderItems as $item) {
                    $orderItem = new OrderItems();
                    $orderItem->order_id = $model->id;
                    $orderItem->order_product_id= $item['id'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->save();
                }

                // Очищаем корзину после оформления заказа
                Yii::$app->session->remove('cart');

                return $this->redirect(['checkout', 'id' => $model->id]);
            }
        }

        return $this->render('checkout', [
            'model' => $model,
            'orderItems' => $orderItems,
        ]);
    }

}
