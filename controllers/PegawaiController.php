<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PegawaiPegawai;
use app\models\PegawaiJenisPns;
use yii\web\NotFoundHttpException;
use app\models\PegawaiPegawaiSearch;
use app\models\PegawaiStatusKepegawaian;

/**
 * PegawaiController implements the CRUD actions for PegawaiPegawai model.
 */
class PegawaiController extends Controller
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
     * Lists all PegawaiPegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiPegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $statusKepegawaian = PegawaiStatusKepegawaian::find()->all();
        $jenisKepegawaian = PegawaiJenisPns::find()->all();
        $model = new PegawaiPegawai();

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusKepegawaian' => $statusKepegawaian,
            'jenisKepegawaian' => $jenisKepegawaian
        ]);
    }

    /**
     * Displays a single PegawaiPegawai model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
       $model = PegawaiPegawai::find()->where(['pegawai_id' => $id])->one();
         
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

    /**
     * Creates a new PegawaiPegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PegawaiPegawai();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_nip_nrp]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PegawaiPegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PegawaiPegawai::find()->where(['pegawai_id' => $id])->one();

        
        $model->kode_dokter_maping_simrs = Yii::$app->request->post('kode_simrs');
        $model->status_aktif_pegawai = Yii::$app->request->post('status_aktif_pegawai');
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
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'errors' => $model->getErrors()
            ];
        }
            
       

    }

    /**
     * Deletes an existing PegawaiPegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PegawaiPegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PegawaiPegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiPegawai::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
