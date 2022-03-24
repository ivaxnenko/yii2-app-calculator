<?php

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /*
    * @return void
    */
    public function actionInit(): void
    {
        $auth = Yii::$app->authManager;
   
        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($admin, $user);
  
        $auth->assign($admin, 1);
    }
}