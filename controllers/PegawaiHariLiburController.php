<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PegawaiHariLibur;
use yii\web\NotFoundHttpException;
use app\models\PegawaiHariLiburSearch;

/**
 * PegawaiHariLiburController implements the CRUD actions for PegawaiHariLibur model.
 */
class PegawaiHariLiburController extends Controller
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

    /**
     * Lists all PegawaiHariLibur models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiHariLiburSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PegawaiHariLibur();

        return $this->render('index', [
             'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PegawaiHariLibur model.
     * @param integer $id
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
     * Creates a new PegawaiHariLibur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PegawaiHariLibur();

        $model->tanggal       = Yii::$app->request->post('tanggal');
        $model->keterangan       = Yii::$app->request->post('keterangan');

        // echo '<pre>';
        // print_r($model);
        // die;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.',
                'data'  => $model
            ];
        }else{
            $errors = $model->getErrors();
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                 'data'  => $errors
            ];
        }

       
    }
    /**
     * Updates an existing PegawaiHariLibur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->keterangan = Yii::$app->request->post('keterangan');

        // echo '<pre>';
        // print_r($model);
        // die;

        if (Yii::$app->request->post() && $model->save()) {
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


    /**
     * Deletes an existing PegawaiHariLibur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
                'errors'  => $model->getErrors()
            ];
        }  
    }

    /**
     * Finds the PegawaiHariLibur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PegawaiHariLibur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiHariLibur::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
