<?php


namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class KeluarController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $sesi = Yii::$app->user->identity->getSesi();

        if ($sesi->keluar()) {
            Yii::$app->user->logout(true);
        } else {
            Yii::$app->getSession()->setFlash('warning', $sesi->getErrors());
        }

        return $this->goHome();
    }
}