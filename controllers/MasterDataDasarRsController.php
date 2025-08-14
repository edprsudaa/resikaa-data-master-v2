<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\MasterDataDasarRs;
use yii\web\NotFoundHttpException;
use app\models\MasterDataDasarRsSearch;

/**
 * MasterDataDasarRsController implements the CRUD actions for MasterDataDasarRs model.
 */
class MasterDataDasarRsController extends Controller
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

   
    public function actionIndex()
    {
        $searchModel = new MasterDataDasarRsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

  
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

 
    public function actionCreate()
    {
        $model = new MasterDataDasarRs();
        $jenisRumahSakit = MasterDataDasarRs::JENIS_RUMAH_SAKIT;
        $kelasRumahSakit = MasterDataDasarRs::KELAS_RUMAH_SAKIT;
        $statusPenyelenggaraSosial = MasterDataDasarRs::STATUS_PENYELENGGARA_SWASTA;
        $kabupaten       = MasterDataDasarRs::getKabupaten();

        if ($model->load(Yii::$app->request->post())) {
            
                // echo '<pre>';
                // print_r($model);
                // die;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return json_encode($model->errors);
            }
            return $this->redirect(['create']);
        }

        return $this->render('create', [
            'model' => $model,
            'jenisRumahSakit'               => $jenisRumahSakit,
            'kelasRumahSakit'               => $kelasRumahSakit,
            'statusPenyelenggaraSosial'     => $statusPenyelenggaraSosial,
            'kabupaten'                     => $kabupaten
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $jenisRumahSakit = MasterDataDasarRs::JENIS_RUMAH_SAKIT;
        $kelasRumahSakit = MasterDataDasarRs::KELAS_RUMAH_SAKIT;
        $statusPenyelenggaraSosial = MasterDataDasarRs::STATUS_PENYELENGGARA_SWASTA;
        $kabupaten       = MasterDataDasarRs::getKabupaten();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->session->setFlash('success', 'Data Berhasil Disimpan.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'                         => $model,
            'jenisRumahSakit'               => $jenisRumahSakit,
            'kelasRumahSakit'               => $kelasRumahSakit,
            'statusPenyelenggaraSosial'     => $statusPenyelenggaraSosial,
            'kabupaten'                     => $kabupaten
        ]);
    }

   
    public function actionDelete($id)
    {
        $model  = $this->findModel($id);

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Data Berhasil Dihapus.');           
            return $this->redirect(['index']);
        }

    }

    protected function findModel($id)
    {
        if (($model = MasterDataDasarRs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
