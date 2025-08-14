<?php

namespace app\controllers;

use Yii;
use app\models\UNIT;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\PegawaiUnitPenempatan;
use app\models\PegawaiUnitPenempatanSearch;

/**
 * PegawaiUnitPenempatanController implements the CRUD actions for PegawaiUnitPenempatan model.
 */
class PegawaiUnitPenempatanController extends Controller
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
     * Lists all PegawaiUnitPenempatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiUnitPenempatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PegawaiUnitPenempatan();
        $model->aktif =1;
        $unit_rumpun = PegawaiUnitPenempatan::find()->where(['is_deleted' => null])->orderBy(['kode'=> SORT_ASC])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

        } 
        

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'unit_rumpun'   => $unit_rumpun
        ]);
    }

    /**
     * Displays a single PegawaiUnitPenempatan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id);
         
        if ($model) {
            return [
                'success' => true,
                'message' => 'Data Ditemukan.',
                'data'    => $model
            ];

        }else{               
            $errors = $model->getErrors();      
            return [
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data'  => null
            ];

        }
    }

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PegawaiUnitPenempatan::find()->where(['kode'=>$id])->one();

        $model->nama    = Yii::$app->request->post('nama');
        $model->unit_rumpun = Yii::$app->request->post('unit_rumpun');
        $model->kode_unitsub_maping_simrs       = Yii::$app->request->post('kode_unitsub_maping');
        $model->aktif = Yii::$app->request->post('aktif');
        $model->is_igd = Yii::$app->request->post('is_igd');
        $model->is_rj = Yii::$app->request->post('is_rj');
        $model->is_ri = Yii::$app->request->post('is_ri');
        $model->is_lab_pa = Yii::$app->request->post('is_lab_pa');
        $model->is_lab_pk = Yii::$app->request->post('is_lab_pk');
        $model->is_radiologi = Yii::$app->request->post('is_radiologi');
        $model->is_ok = Yii::$app->request->post('is_ok');
        $model->is_hd = Yii::$app->request->post('is_hd');
        $model->is_lab_bio = Yii::$app->request->post('is_lab_bio');
        $model->is_rehab_medik = Yii::$app->request->post('is_rehab_medik');
        $model->is_radioterapi = Yii::$app->request->post('is_radioterapi');
        $model->is_penunjang = Yii::$app->request->post('is_penunjang');
        $model->aktif = Yii::$app->request->post('aktif');

        $model->updated_at   = date('Y-m-d H:i:s');
        $model->updated_by   = Yii::$app->user->identity->id;       

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

  

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = PegawaiUnitPenempatan::find()->where(['kode'=>$id])->one();
        $model->is_deleted = 1;
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
      
    
    /**
     * Finds the PegawaiUnitPenempatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PegawaiUnitPenempatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiUnitPenempatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
