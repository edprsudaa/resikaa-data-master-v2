<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Penghasilan;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\PenghasilanSearch;

/**
 * AplikasiController implements the CRUD actions for Aplikasi model.
 */
class PenghasilanController extends Controller
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
        $searchModel = new PenghasilanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Penghasilan();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $model = new Penghasilan();

        $model->nama = $request->post('nama');

        if($model->save())
        {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Ditambah.',
            ];
        }else{
            $errors = $model->getErrors();
            return [
                'status' => 400,
                'message' => 'Gagal menambah data.',
                'data'  => $errors
            ];
        }       

        
    }   
  
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $model = $this->findModel($id);
        $model->nama = $request->post('nama');

        if($model->save())
        {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Diubah.',
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

   
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->deleted_at = date('Y-m-d H:i:s');

        if ($model->save()) {
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

   
    protected function findModel($id)
    {
        if (($model = Penghasilan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
