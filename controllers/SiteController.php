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
            return $this->goBack();
        }

//        $model->password = '';
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionProducts() {
        $dataProvider = Products::find()->all();
        return $this->render('products', ['dataProvider' => $dataProvider]);
    }
    public function actionProduct($id) {
        $product = Products::findOne($id);
        return $this->render('product', ['product' => $product]);

    }
    public function actionCart() {
        $cart = Yii::$app->session->get('cart', []);
        return $this->render('cart', ['cart' => $cart]);
    }
    public function actionCheckout() {
        $checkout = new Orders();
        return $this->render('checkout', ['checkout'=> $checkout]);
    }
    public function actionRegister()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goBack();
//        }
//        Yii::$app->response->cookies->add(new \yii\web\Cookie([
//            'name' => 'language',
//            'value' => 'zh-CN',
//        ]));
//        $model = new RegisterForm();
//        if ($model->load(Yii::$app->request->post()) && $model->register()) {
//            return $this->goBack();
//        }
//        return $this->render('register', [
//            'model' => $model,
//        ]);
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => 'zh-CN',
        ]));
        $model = new RegisterForm();
        $model->role = Users::ROLE_USER;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success');
            return $this->redirect(['index']);

        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }

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
