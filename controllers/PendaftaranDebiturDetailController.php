<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PendaftaranDebitur;
use yii\web\NotFoundHttpException;
use app\models\PendaftaranDebiturDetail;
use app\models\PendaftaranDebiturDetailSearch;

/**
 * PendaftaranDebiturDetailController implements the CRUD actions for PendaftaranDebiturDetail model.
 */
class PendaftaranDebiturDetailController extends Controller
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
     * Lists all PendaftaranDebiturDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PendaftaranDebiturDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $debitur = PendaftaranDebitur::find()->select('kode, nama')->all();
        $model = new PendaftaranDebiturDetail();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'debitur' => $debitur,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single PendaftaranDebiturDetail model.
     * @param string $id
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
     * Creates a new PendaftaranDebiturDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PendaftaranDebiturDetail();

        $debiturKode = Yii::$app->request->post('debitur');

        // $maxKode = PendaftaranDebiturDetail::find()->where(['debitur_kode'=>$debiturKode])->max('kode');
        // $model->kode       = empty($maxKode) ? $debiturKode.'01' : $maxKode + 1;

        $model->kode       = Yii::$app->request->post('kode');
        $model->nama       = Yii::$app->request->post('nama');
        $model->debitur_kode  = Yii::$app->request->post('debitur');
        $model->aktif      = 1;
        $model->created_at = date('Y-m-d H:i:s');        
        $model->created_by = Yii::$app->user->identity->id;

        // echo '<pre>';
        // print_r($model);
        // die;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.',
                'data'  => $model
            ];
        }else{
            $errors = $model->getErrors();
            $errorMessages = [];
            foreach ($errors as $attribute => $attributeErrors) {
                foreach ($attributeErrors as $error) {
                    $errorMessages[] = $error;
                }
            }

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                'data'  => $errorMessages
            ];
        }

       
    }


    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->nama = Yii::$app->request->post('nama');
        $model->debitur_kode = Yii::$app->request->post('debitur');
        $model->aktif = Yii::$app->request->post('aktif');

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

        if ($model->delete()) {
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

    
    protected function findModel($id)
    {
        if (($model = PendaftaranDebiturDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
