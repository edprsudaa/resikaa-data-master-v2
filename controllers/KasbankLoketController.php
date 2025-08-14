<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\KasbankLoket;
use yii\filters\AccessControl;
use app\models\KasbankLoketSearch;
use yii\web\NotFoundHttpException;

/**
 * KasbankLoketController implements the CRUD actions for KasbankLoket model.
 */
class KasbankLoketController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        //'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all KasbankLoket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KasbankLoketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new KasbankLoket();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single KasbankLoket model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
           
        ]);
    }

    /**
     * Creates a new KasbankLoket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new KasbankLoket();

        Yii::$app->response->format = Response::FORMAT_JSON;

        $maxKode = KasbankLoket::find()->where(['not',['kode'=>99]])->max('kode');

        $model->kode = $maxKode + 1;
        $model->loket_pembayaran = Yii::$app->request->post('loket_pembayaran');
        $model->lkasir = Yii::$app->request->post('kasir');
        $model->lregistrasi = Yii::$app->request->post('registrasi');
        $model->status     = 1;


        // echo '<pre>';
        // print_r($model);die;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                'error' => $model->getErrors()
            ];
        }
     
    }
   
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->loket_pembayaran = Yii::$app->request->post('loket_pembayaran');
        $model->lkasir = Yii::$app->request->post('lkasir');
        $model->lregistrasi = Yii::$app->request->post('lregistrasi');
        $model->status = Yii::$app->request->post('status');

        // echo '<pre>';
        // print_r(Yii::$app->request->post());
        // die;

        if (Yii::$app->request->post() && $model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Diubah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'error' => $model->getErrors()
            ];
        }

    }

    /**
     * Deletes an existing KasbankLoket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 

        $model = $this->findModel($id);  

        if ($model->delete()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{                    
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'error' => $model->getErrors()
            ];
        }  
    }

    /**
     * Finds the KasbankLoket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return KasbankLoket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KasbankLoket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
