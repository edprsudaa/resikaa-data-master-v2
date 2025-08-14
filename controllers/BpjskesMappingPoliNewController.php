<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\BpjskesMappingPoliNew;
use app\models\BpjskesMappingPoliNewSearch;

/**
 * BpjskesMappingPoliNewController implements the CRUD actions for BpjskesMappingPoliNew model.
 */
class BpjskesMappingPoliNewController extends Controller
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
     * Lists all BpjskesMappingPoliNew models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BpjskesMappingPoliNewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new BpjskesMappingPoliNew();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

 
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new BpjskesMappingPoliNew();      
       
        if ($model->load(Yii::$app->request->post())) {
           
            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Ditambah.',
                    'data'  => $model
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
      
    }

    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
       
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {

            $data = Yii::$app->request->post();

            $model->bpjs_kode = $data['bpjs_kode'];
            $model->bpjs_nama = $data['bpjs_nama'];
            $model->bpjs_sub_kode = $data['bpjs_sub_kode'];
            $model->bpjs_sub_nama = $data['bpjs_sub_nama'];
            $model->simrs_kode = $data['simrs_kode'];

            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Diubah.',
                    'data'  => $model
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
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->delete()) {
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
        if (($model = BpjskesMappingPoliNew::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
