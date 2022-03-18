<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for User model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
          return $this->render('index');
    }
}
