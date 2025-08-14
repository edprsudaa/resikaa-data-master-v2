<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\MedisKamar;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\MedisTarifKamar;
use app\models\MedisKamarSearch;
use yii\web\NotFoundHttpException;
use app\models\PegawaiUnitPenempatan;
use app\models\PendaftaranKelasRawat;

/**
 * MedisKamarController implements the CRUD actions for MedisKamar model.
 */
class MedisKamarController extends Controller
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
     * Lists all MedisKamar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisKamarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $unit_penempatan = PegawaiUnitPenempatan::find()->where(['and',['is_ri' => 1],['aktif'=>1],['is_deleted' => null]])->all();
        $kelas_rawat = PendaftaranKelasRawat::find()->all();
        $model = new MedisKamar();
        $model->cadangan = 0; // Default value for cadangan

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'unit_penempatan' => $unit_penempatan,
            'kelas_rawat' => $kelas_rawat,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single MedisKamar model.
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
     * Creates a new MedisKamar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisKamar();

        Yii::$app->response->format = Response::FORMAT_JSON;

        $model->unit_id          = Yii::$app->request->post('kode_unit');
        $model->kelas_rawat_kode = Yii::$app->request->post('kelas_rawat');
        $model->no_kamar         = Yii::$app->request->post('nomor_kamar');
        $model->no_kasur         = Yii::$app->request->post('nomor_kasur');
        $model->cadangan         = Yii::$app->request->post('kategori_bed');

        $model->created_at      = date('Y-m-d H:i:s');
        $model->created_by      = Yii::$app->user->identity->id;
        $model->aktif           = 1;
        $model->kondisi         = 1;
        $model->is_deleted         = 0;


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
                'message' => 'Terjadi kesalahan saat Menambahkan Data.'
            ];
        }
     
    }

    /**
     * Updates an existing MedisKamar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->unit_id          = Yii::$app->request->post('unit_id');
        $model->kelas_rawat_kode = Yii::$app->request->post('kelas_rawat_kode');
        $model->no_kamar         = Yii::$app->request->post('no_kamar');
        $model->no_kasur         = Yii::$app->request->post('no_kasur');
        $model->aktif            = Yii::$app->request->post('aktif');
        $model->kondisi            = Yii::$app->request->post('kondisi');
        $model->cadangan            = Yii::$app->request->post('kategori_bed');

        $model->updated_at      = date('Y-m-d H:i:s');
        $model->updated_by      = Yii::$app->user->identity->id;

       

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
     * Deletes an existing MedisKamar model.
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
     * Finds the MedisKamar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisKamar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisKamar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
