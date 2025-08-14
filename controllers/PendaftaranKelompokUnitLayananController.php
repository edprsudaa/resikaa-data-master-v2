<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\models\PegawaiUnitPenempatan;
use Yii;
use app\models\PendaftaranKelompokUnitLayanan;
use app\models\PendaftaranKelompokUnitLayananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * PendaftaranKelompokUnitLayananController implements the CRUD actions for PendaftaranKelompokUnitLayanan model.
 */
class PendaftaranKelompokUnitLayananController extends Controller
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

   
    public function actionIndex()
    {
        $searchModel = new PendaftaranKelompokUnitLayananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $unit_penempatan = PegawaiUnitPenempatan::find()->where(['is_deleted' => null])->all();
        $model = new PendaftaranKelompokUnitLayanan();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'unit_penempatan' => $unit_penempatan,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single PendaftaranKelompokUnitLayanan model.
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
     * Creates a new PendaftaranKelompokUnitLayanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PendaftaranKelompokUnitLayanan();

        $model->unit_id       = Yii::$app->request->post('unit');
        $model->type = Yii::$app->request->post('type');

        $cekUnit = PendaftaranKelompokUnitLayanan::find()
        ->where([
            'unit_id' => Yii::$app->request->post('unit'),
            'type'    => Yii::$app->request->post('type')
        ])
        ->one();

        if (!empty($cekUnit)) {
            return [
                'status'    => 200,
                'message' => 'Unit Telah Terdaftar.',
                'data'  => $cekUnit
            ];
        }

        if (Yii::$app->request->post() && $model->save()) {
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

   
   public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->unit_id = Yii::$app->request->post('unit');
        $model->type = Yii::$app->request->post('type');
      

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
        if (($model = PendaftaranKelompokUnitLayanan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUnitnya()
    {
        $kode = $_POST['kode'];
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get_unit = PendaftaranKelompokUnitLayanan::find()
            ->select('unit_id')
            ->where(['type' => $kode])->all();
        // ->createCommand()->getRawSql();
        //var_dump($get_tarif_tindakan);exit;
        // echo "<pre>";
        // print_r($get_tarif_tindakan);
        // die;
        // $array_data_unit = implode(',', ArrayHelper::getColumn($get_unit, function ($element) {
        //     return $element['unit_id'];
        // }));

        $array_data_unit = [];
        foreach ($get_unit as $v) {
            $array_data_unit[] = $v['unit_id'];
        }

        // var_dump($get_tarif_tindakan);
        // var_dump($array_data_tindakan);
        // exit;
        if (empty($get_unit)) {
            $data = PegawaiUnitPenempatan::find()->asArray()->all();
        } else {
            $data = PegawaiUnitPenempatan::find()->where(['NOT IN', 'kode', $array_data_unit])->asArray()->all();
        }

        //$data = ::find()->where(['kode'=>$_POST['kode']])->asArray()->one();
        //var_dump($data);exit;
        // echo "<pre>";
        // print_r($data);
        // die;
        return $data;
    }
}
