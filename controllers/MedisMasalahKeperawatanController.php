<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\components\Helper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\MedisMasalahKeperawatan;
use app\models\MedisMasalahKeperawatanSearch;

/**
 * MedisMasalahKeperawatanController implements the CRUD actions for MedisMasalahKeperawatan model.
 */
class MedisMasalahKeperawatanController extends Controller
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
     * Lists all MedisMasalahKeperawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisMasalahKeperawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new MedisMasalahKeperawatan();
        $masalah_keperawatan = $model->getMasalahKeperawatan();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'masalah_keperawatan' => $masalah_keperawatan,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single MedisMasalahKeperawatan model.
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
     * Creates a new MedisMasalahKeperawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $model = new MedisMasalahKeperawatan();

        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $parentId = Yii::$app->request->post('parent');


        if(empty($parentId)){
            $getData = MedisMasalahKeperawatan::find()->where(['parent_id' => null])->count();
            $maxKode = $getData + 1;
            $kode = Helper::angkaRomawi($maxKode);
            // print_r($kode);
        }else{
            $getData = MedisMasalahKeperawatan::find()->where(['not',['parent_id' => null ]])->max('kode');
            $kode = empty($getData) ? '0000' :  sprintf("%04d", $getData + 1);
        }


        $model->kode      = $kode;
        $model->parent_id = Yii::$app->request->post('parent');
        $model->deskripsi = Yii::$app->request->post('deskripsi');
        $model->aktif     = 1;

        $model->created_at = date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->identity->id;
        $model->is_deleted = 0;

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
        $model->deskripsi = Yii::$app->request->post('deskripsi');
        $model->aktif = Yii::$app->request->post('aktif');
        $model->parent_id = Yii::$app->request->post('parent');

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

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 

        $model = $this->findModel($id);   
        $model->is_deleted = 1;  

        if ($model->save()) {
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
     * Finds the MedisMasalahKeperawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisMasalahKeperawatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisMasalahKeperawatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
