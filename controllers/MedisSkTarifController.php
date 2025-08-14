<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\MedisSkTarif;
use yii\filters\AccessControl;
use app\models\MedisSkTarifSearch;
use yii\web\NotFoundHttpException;

/**
 * MedisSkTarifController implements the CRUD actions for MedisSkTarif model.
 */
class MedisSkTarifController extends Controller
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
     * Lists all MedisSkTarif models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisSkTarifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new MedisSkTarif();

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MedisSkTarif model.
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
     * Creates a new MedisSkTarif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

     
    public function actionCreate()
    {        
        
        $model = new MedisSkTarif();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $nomor      = Yii::$app->request->post('nomor');    
        $tanggal    = Yii::$app->request->post('tanggal');    
        $keterangan = Yii::$app->request->post('keterangan');          

        $model->tanggal     = \Yii::$app->formatter->asDate($tanggal, 'yyyy-MM-dd');
        $model->aktif       = 1;
        $model->nomor       = $nomor;
        $model->keterangan  = $keterangan;   
        $model->created_by  = Yii::$app->user->identity->id;
        $model->is_deleted  = 0;     
        
        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Disimpan.'
            ];

        }else{                    
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ];
        }                    
      

    }

    /**
     * Updates an existing MedisSkTarif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model              = $this->findModel($id);
        $model->nomor       = Yii::$app->request->post('nomor'); 
        $model->keterangan  = Yii::$app->request->post('keterangan'); 
        $model->aktif       = Yii::$app->request->post('aktif');         
        $model->tanggal     = \Yii::$app->formatter->asDate(Yii::$app->request->post('tanggal'), 'yyyy-MM-dd');
        $model->updated_by  = Yii::$app->user->identity->id;
        $model->updated_at  = date('Y-m-d H:i:s');

        // echo '<pre>';
        // print_r($model);die;

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

    /**
     * Deletes an existing MedisSkTarif model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model              = $this->findModel($id);
        $model->is_deleted  = 1;         
        $model->updated_at  = date('Y-m-d H:i:s');
        
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

    /**
     * Finds the MedisSkTarif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisSkTarif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisSkTarif::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
