<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\MedisKamar;
use yii\filters\VerbFilter;
use app\models\MedisSkTarif;
use yii\filters\AccessControl;
use app\models\MedisTarifKamar;
use yii\web\NotFoundHttpException;
use app\models\MedisTarifKamarSearch;
use app\models\PendaftaranKelasRawat;

/**
 * MedisTarifKamarController implements the CRUD actions for MedisTarifKamar model.
 */
class MedisTarifKamarController extends Controller
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
     * Lists all MedisTarifKamar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisTarifKamarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $kelas_rawat = PendaftaranKelasRawat::find()->all();
        $kamar = MedisTarifKamar::DataKamar();
        $allKamar = MedisKamar::DataKamar();
        $sk_tarif = MedisSkTarif::find()->all();
        $model = new MedisTarifKamar();

        // echo "<pre>";
        // print_r($sk_tarif);
        // die;

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'kelas_rawat' => $kelas_rawat,
            'kamar' => $kamar,
            'allKamar' => $allKamar,
            'sk_tarif' => $sk_tarif,
        ]);
    }

    /**
     * Displays a single MedisTarifKamar model.
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
     * Creates a new MedisTarifKamar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

     public function actionCreate()
    {
        $model = new MedisTarifKamar();

        Yii::$app->response->format = Response::FORMAT_JSON;

        $model->kamar_id          = Yii::$app->request->post('kamar');
        $model->sk_tarif_id = Yii::$app->request->post('skTarif');
        $model->biaya         = Yii::$app->request->post('biaya');

        $model->created_at      = date('Y-m-d H:i:s');
        $model->created_by      = Yii::$app->user->identity->id;
        $model->is_deleted           = 0;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat Menambahkan Data.'
            ];
        }
     
    }
   

    /**
     * Updates an existing MedisTarifKamar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->kamar_id    = Yii::$app->request->post('kamar_id');
        $model->sk_tarif_id = Yii::$app->request->post('sk_tarif_id');
        $model->biaya       = Yii::$app->request->post('biaya');

        $model->updated_at   = date('Y-m-d H:i:s');
        $model->updated_by   = Yii::$app->user->identity->id;       

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
     * Deletes an existing MedisTarifKamar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;

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

    /**
     * Finds the MedisTarifKamar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisTarifKamar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisTarifKamar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
