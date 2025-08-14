<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\components\Auth;
use app\models\Aplikasi;
use yii\filters\VerbFilter;
use app\models\AplikasiSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * AplikasiController implements the CRUD actions for Aplikasi model.
 */
class AplikasiController extends Controller
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
                        'actions' => ['logout', 'index','create','update','view','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Lists all Aplikasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AplikasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Aplikasi();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Aplikasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = $this->findModel($id);

        return [
            'status' => 200,
            'message' => 'Data Berhasil Ditampilkan.',
            'data'  => $data
        ];
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Aplikasi();
       
        if ($model->load(Yii::$app->request->post())) {

            $model->kda = 'rsudArifinInap';
            $model->sta = true;
            $model->icn = '';
            $model->crd = date('Y-m-d H:i:s');
            $model->mdd = date('Y-m-d H:i:s');

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

  
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
       
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {

            $data = Yii::$app->request->post();

            $model->nma = $data['nama'];
            $model->prm = $data['permission'];
            $model->lnk = $data['link'];
            $model->kda = $data['kode'];
            $model->inf = $data['deskripsi'];
            $model->mdd = date('Y-m-d H:i:s');

            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Diubah.',
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

   
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->delete()) {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{               
            $errors = $model->getErrors();      
            return [
                'status' => 400,
                'message' => 'Terjadi kesalahan saat Menghapus Data.',
                'data'  => $errors
            ];

        }
    }

    // public function actionShow()

    /**
     * Finds the Aplikasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aplikasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aplikasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
