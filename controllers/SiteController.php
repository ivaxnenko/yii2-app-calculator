<?php

namespace app\controllers;

use Yii;
use app\models\Complete;
use app\models\Material;
use app\models\Month;
use app\models\Price;
use yii\web\Controller;
use app\models\Weight;
use yii\helpers\ArrayHelper;
use app\models\SignupForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Orders;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index','login','signup','init'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['orders'],
                        'allow' => true,
                        'roles' => ['admin','user']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

     /**
     * @inheritdoc
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
      
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            $user = new User();
            $user->username = $model->username;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);

            if($user->save())
            {
                Yii::$app->user->login($user);

                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->getId());

                return $this->goHome();
            }
        }
        return $this->render('signup', compact('model'));
    }

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

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionOrders()
    {
            $orders = Orders::find()
            ->where(['user_id' => \Yii::$app->user->identity->id])
            ->asArray()
            ->all();

            return $this->render('orders',compact('orders'));   
    }

    public function actionIndex()
    {
        $month = Month::find()->all();
        $material = Material::find()->all();
        $weight = Weight::find()->all();
        $currentPrice = null;
        $currentTable = null;

        $material  = ArrayHelper::map($material,'id','name');
        $month  = ArrayHelper::map($month,'id','name');
        $weight  = ArrayHelper::map($weight,'id','count');

        $model = new Complete();

        $model->attributes = \Yii::$app->request->post('Complete');

        if ($model->load(\Yii::$app->request->post()))
        {
            $price = Price::findOne([
                'material_id' => $model['material'],
                'weight_id' => $model['weight'],
                'month_id' => $model['month'],
            ]);

            $table = Price::findAll([
                'material_id' => $model['material']
            ]);

            $currentTable = ArrayHelper::toArray($table);
            $currentPrice = $price['price'] * 25 * $model['weight'];

            if (!\Yii::$app->user->isGuest)
            {
                $order = new Orders();

                $order->user_id = \Yii::$app->user->identity->id;
                $order->type = $material[$model['material']];
                $order->weight = $weight[$model['weight']];
                $order->month = $month[$model['month']];
                $order->price = $currentPrice;
                $order->tprice = $price['price'];
    
                $order->save();
            }
        }
        

        return $this->render('index',compact('month','material','weight', 'model','currentPrice','currentTable'));
    }
}
