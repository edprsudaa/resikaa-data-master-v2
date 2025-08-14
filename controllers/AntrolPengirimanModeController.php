<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\emr\pendaftaran\AntrolPengirimanMode;

class AntrolPengirimanModeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = AntrolPengirimanMode::find()->one(); // hanya satu baris

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionChangeMode()
    {
        date_default_timezone_set('Asia/Jakarta');
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $mode = Yii::$app->request->post('mode');

        $model = AntrolPengirimanMode::findOne($id);

        if ($model) {
            $model->mode = $mode;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->id ?? null;

            if ($model->save(false)) {
                return ['success' => true];
            }
        }

        return ['success' => false];
    }

}
