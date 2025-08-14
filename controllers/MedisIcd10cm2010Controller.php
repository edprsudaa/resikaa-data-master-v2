<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\MedisIcd10cm2010;
use yii\web\NotFoundHttpException;
use app\models\MedisIcd10cm2010Search;

/**
 * MedisIcd10cm2010Controller implements the CRUD actions for MedisIcd10cm2010 model.
 */
class MedisIcd10cm2010Controller extends Controller
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
     * Lists all MedisIcd10cm2010 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisIcd10cm2010Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new MedisIcd10cm2010();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single MedisIcd10cm2010 model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        // print_r($model);
        // exit;
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new MedisIcd10cm2010 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new MedisIcd10cm2010();

        // $kode = strtolower(Yii::$app->request->post('kode'));
        // $cekKode = MedisIcd10cm2010::find()->where(['kode'=> $kode])->andWhere(['is_deleted'=>0])->one();

        // echo '<pre>';
        // print_r($cekKode);die;

        // if (!empty($cekKode)) {
        //     return [
        //         'status'    => 1,
        //         'message' => 'Kode Telah Terdaftar.',
        //         'data'  => $cekKode
        //     ];
        // }

        if (Yii::$app->request->post()) {
            $model->aktif = 1;
            $model->is_deleted = 0;
            $model->kode = Yii::$app->request->post('kode');
            $model->deskripsi = Yii::$app->request->post('deskripsi');
            $model->keterangan = Yii::$app->request->post('kode').'-'.Yii::$app->request->post('deskripsi');
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;


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
       
    }

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->kode = Yii::$app->request->post('kode');
        $model->deskripsi = Yii::$app->request->post('deskripsi');
        $model->keterangan = Yii::$app->request->post('kode').'-'.Yii::$app->request->post('deskripsi');
        $model->aktif = Yii::$app->request->post('status');
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;


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

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id); 
        $model->is_deleted = '1';
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;
        
        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{               
            $errors = $model->getErrors();      
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'data'  => $errors
            ];

        }
    }

    
    protected function findModel($id)
    {
        if (($model = MedisIcd10cm2010::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
