<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PegawaiJurusan;
use yii\web\NotFoundHttpException;
use app\models\PegawaiJurusanSearch;

/**
 * PegawaiJurusanController implements the CRUD actions for PegawaiJurusan model.
 */
class PegawaiJurusanController extends Controller
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
     * Lists all PegawaiJurusan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PegawaiJurusan();
        $searchModel = new PegawaiJurusanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $jenisPendidikan = PegawaiJurusan::getAllJenisPendidikan();

        // echo '<pre>';
        // print_r($jenisPendidikan);die;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

        } 

        return $this->render('index', [
            'model' => $model,
            'jenisPendidikan' => $jenisPendidikan,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PegawaiJurusan model.
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

   
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->kode = Yii::$app->request->post('kode');
        $model->kode_jurusan = Yii::$app->request->post('kode_jurusan');
        $model->nama_jurusan = Yii::$app->request->post('nama_jurusan');
        $model->aktif = Yii::$app->request->post('aktif');

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
     * Deletes an existing PegawaiJurusan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = PegawaiJurusan::find()->where(['kode_jurusan' => $id])->one();
        $model->is_deleted = 1;

        // print_r($model);die;
         
        if ($model->save()) {
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

    public function actionGetMaxKode()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $kode = Yii::$app->request->post('kode');
        $jurusan = PegawaiJurusan::find()->where(['kode' => $kode])->max('kode_jurusan');
        
        if (empty($jurusan)) {
            $maxKode = $kode .'00001';
        }else{
            $maxKode = $jurusan + 1;
        }       
        
         return [
                'success' => true,
                'data'     => $maxKode
               
            ];

      
    }

    /**
     * Finds the PegawaiJurusan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PegawaiJurusan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiJurusan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
