<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\PegawaiPendidikanUmum;
use app\models\PegawaiPendidikanUmumSearch;

/**
 * PegawaiPendidikanUmumController implements the CRUD actions for PegawaiPendidikanUmum model.
 */
class PegawaiPendidikanUmumController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
        $searchModel = new PegawaiPendidikanUmumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PegawaiPendidikanUmum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

        } 

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

   
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PegawaiPendidikanUmum::find()->where(['kode'=>$id])->one();

        $model->kode = Yii::$app->request->post('kode');
        $model->kode_max_gol = Yii::$app->request->post('kode_max_gol');
        $model->pendidikan_umum = Yii::$app->request->post('pendidikan');

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Diubah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.'
            ];
        }
            
       

    }
  
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = PegawaiPendidikanUmum::find()->where(['kode' => $id])->one();
         
        if ($model->delete()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{                    
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.'
            ];
        }  
    }

   
    protected function findModel($id)
    {
        if (($model = PegawaiPendidikanUmum::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
