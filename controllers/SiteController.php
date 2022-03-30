<?php

namespace app\controllers;

use Yii;
use app\models\Complete;
use yii\web\Controller;
use app\models\Price;
use yii\helpers\ArrayHelper;
use app\models\SignupForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Orders;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use app\components\Command;
use app\components\CommandContext;


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
                        'actions' => ['index','login','signup','init','error'],
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

    /**
    * @return Response|string
    */

    public function actionSignup()
    {
        if (Yii::$app->user->isGuest === false) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new User;
            $user->username = $model->username;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);

            if($user->save()) {
                Yii::$app->user->login($user);

                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->getId());

                return $this->goHome();
            }
        }
        return $this->render('signup',['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin()
    {
        if (Yii::$app->user->isGuest === false) {
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

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        
        return $this->goHome();
    }

    /**
     * Orders action.
     *
     * @return string
     */

    public function actionOrders(): string
    {
            $dataProvider = new ActiveDataProvider([
                'query' => Orders::find(),
                'pagination' => [
                    'pageSize' => 50
                ],
            ]);

            return $this->render('orders',compact('dataProvider'));   
    }

    /**
     * Index action.
     *
     * @return string
     */

    public function actionIndex():string
    {
        $currentPrice = null;
        $model = new Complete();

        if ($model->load(\Yii::$app->request->post())) {
            $cmd = new Command;
            $context = new CommandContext;

            $model->price = Price::findOne([
                'material_id' => $model->material,
                'weight_id' => $model->weight,
                'month_id' => $model->month,
            ]);

            $model->table = ArrayHelper::toArray(Price::findAll([
                'material_id' => $model->material
            ]));

            $context->price = $model->price->price * 25 * $model->weight;
            $context->distance = $model->distance;

            $cmd->calculatePriceByDistance($context);

            $model->tprice = $context->result;

            if (!\Yii::$app->user->isGuest) {
                $order = new Orders();
                $order->loadValues($model);
                $order->save();

                Yii::$app->session->setFlash('success', "Рассчет успешно сохранен!");
            }
        }
        
        return $this->render('index',compact('model'));
    }
}
