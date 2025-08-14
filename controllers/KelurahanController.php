<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\Kabupaten;
use app\models\Kelurahan;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\KelurahanSearch;
use yii\web\NotFoundHttpException;

/**
 * KelurahanController implements the CRUD actions for Kelurahan model.
 */
class KelurahanController extends Controller
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
     * Lists all Kelurahan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelurahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Kelurahan();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }


    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Kelurahan();
       
        if ($model->load(Yii::$app->request->post())) {

            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->aktif   = 1;
           
            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Ditambah.',
                    'data'  => $model
                ];
            }else{
                $errors = $model->getErrors();
                return [
                    'status' => 400,
                    'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                    'data'  => $errors
                ];
            }

        } 
      
    }
  

    /**
     * Updates an existing Kelurahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;     

        if (Yii::$app->request->post()) {
            $model->kode_prov_kab_kec_kelurahan= Yii::$app->request->post('kode_kelurahan');
            $model->nama = Yii::$app->request->post('nama_kelurahan');
            $model->kode_prov_kab_kec = Yii::$app->request->post('kode_kecamatan');
            $model->kode_prov_kab = Yii::$app->request->post('kode_kabupaten');
            $model->kode_prov = Yii::$app->request->post('kode_provinsi');
            $model->aktif = Yii::$app->request->post('aktif');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;


            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Diubah.',
                    'data'  => $model
                ];
            }else{
                $errors = $model->getErrors();
                return [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat Mengubah Data.',
                    'data'  => $errors
                ];
            }
            
        }

       
    }

    /**
     * Deletes an existing Kelurahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->is_deleted =1;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->save()) {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{               
            $errors = $model->getErrors();      
            return [
                'status' => 400,
                'message' => 'Terjadi kesalahan saat Menghapus Data Ini.',
                'data'  => $errors
            ];

        }
    }

    /**
     * Finds the Kelurahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kelurahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelurahan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
