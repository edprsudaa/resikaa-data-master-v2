<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\MedisTindakan;
use yii\filters\AccessControl;
use app\models\MedisTarifTindakan;
use yii\web\NotFoundHttpException;
use app\models\PegawaiUnitPenempatan;
use app\models\PendaftaranKelasRawat;
use app\models\MedisTarifTindakanUnit;
use app\models\MedisTarifTindakanUnitSearch;

/**
 * MedisTarifTindakanUnitController implements the CRUD actions for MedisTarifTindakanUnit model.
 */
class MedisTarifTindakanUnitController extends Controller
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
     * Lists all MedisTarifTindakanUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel        = new MedisTarifTindakanUnitSearch();
        $dataProvider       = $searchModel->search(Yii::$app->request->queryParams);
        $unit_penempatan    = PegawaiUnitPenempatan::find()->where(['is_deleted' => null])->orderBy(['nama' => SORT_ASC])->all();
        $kelasRawat         = PendaftaranKelasRawat::find()->orderBy(['kode' => SORT_ASC])->all();

        $kelasRawat[] = [
            'nama' => 'SEMUA KELAS',
            'kode'  => 'all'
        ];

        $dataTindakan       = MedisTarifTindakanUnit::getTindakannya();

        $tindakanUnit = new MedisTarifTindakanUnit();
        $data_tindakan_unit = $tindakanUnit->getTindakanMedis();

        // $data_tindakan = $tindakan->getTindakannya();

        // echo '<pre>';
        // print_r($unit_penempatan);
        // die;

        return $this->render('index', [
            'searchModel'       => $searchModel,
            'dataProvider'      => $dataProvider,
            'unit_penempatan'   => $unit_penempatan,
            'kelasRawat'         => $kelasRawat,
            'dataTindakan'       => $dataTindakan,
            'data_tindakan_unit' => $data_tindakan_unit,
        ]);
    }

    /**
     * Displays a single MedisTarifTindakanUnit model.
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
     * Creates a new MedisTarifTindakanUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisTarifTindakanUnit();
        $unit = PegawaiUnitPenempatan::find()->all();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->created_by = 1;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'unit' => $unit,
        ]);
    }

    /**
     * Updates an existing MedisTarifTindakanUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $unit = PegawaiUnitPenempatan::find()->all();

        if ($model->load(Yii::$app->request->post()) ) {
            $date = date('Y-m-d H:i:s');
            $model->updated_at =$date;
            $model->updated_by = 1;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'unit' => $unit,
        ]);
    }

    /**
     * Deletes an existing MedisTarifTindakanUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $date = date('Y-m-d H:i:s');
        $model = $this->findModel($id);
         
        $model->is_deleted ='1';
        $model->updated_at =$date;
        $model->updated_by = Yii::$app->user->identity->id;
        if ($model->save()) {
            // alert('oke');
            return $this->redirect(['index']);
        } 
    }

    public function actionHapus()
    {
        $id = Yii::$app->request->post('id');
        $model = MedisTarifTindakanUnit::findOne($id);
        // print_r($model);die;
        
        if ($model === null) {
            throw new NotFoundHttpException('The requestesd page does not exist.');
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            $date = date('Y-m-d H:i:s');
            $model->is_deleted = 1;
            $model->updated_at = $date;
            $model->updated_by = Yii::$app->user->identity->id;
            // echo '<pre>';
            //  print_r($model);die;
            if ($model->save()) {
                $transaction->commit();
                Yii::$app->getSession()->setFlash('success', [
                    'title' => 'Data Berhasil Dihapus.',
                    'type' => 'success',
                    'timer' => 4000,
                    'showConfirmButton' => true
                ]);
               
                return $this->redirect(['index']);
            } else {
                $transaction->rollBack();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

   

    

    /**
     * Finds the MedisTarifTindakanUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisTarifTindakanUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisTarifTindakanUnit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTampilData()
    {
        $tindakan = new MedisTarifTindakanUnit();
        $data_tindakan = $tindakan->getTindakanMedis();
        // $data_tindakan = $tindakan->getTindakannya();
        $unit = PegawaiUnitPenempatan::find()->orderBy(['nama' => SORT_ASC])->all();
        $kelas = PendaftaranKelasRawat::find()->orderBy(['kode'=>SORT_ASC])->all();

        // $kelas = MedisTarifTindakan::find()->alias('a')
        // ->select('a.*') // memilih semua kolom dari tabel kelas
        // ->leftJoin(PendaftaranKelasRawat::tableName() . ' AS b', 'a.kode_kelas_rawat = b.kode')
        // // ->where(['b.kode_kelas_rawat' => 'terdaftar'])
        // ->orderBy(['kelas.kode' => SORT_ASC])
        // ->all();
        
        // echo "<pre>";
        // print_r($kelas);
        // die;

        return $this->render('tampil_data', [
            'data_tindakan' => $data_tindakan,
            'unit' => $unit,
            'kelas'=>$kelas
        ]);
    }

    public function actionDataTindakan($q = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = \Yii::$app->db->createCommand("
                SELECT a.id, a.parent_id, a.deskripsi FROM ".MedisTindakan::tableName()." as a where a.id in 
                (select b.tindakan_id FROM ".MedisTarifTindakan::tableName()." as b group by b.tindakan_id) 
                WHERE a.deskripsi LIKE %".$q."%
                order by a.id asc")->queryAll();
            $out['results'] = array_values($data);
        return $out;
        }
    }

    public function actionInputForm()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tindakan=Yii::$app->request->post('tindakannya');
        // $unit=Yii::$app->request->post('unitId');

        // print_r($unit);die;
        $model = new MedisTarifTindakanUnit();
        $data = $model->getTarifTindakanUnit($tindakan);

        $response1 = [
            'con' => true,
            'result' => $data,
            'message' => 'Sukses'
        ];
        
        $response2 = [
            'con' => false,
            'message' => 'Data Tidak Ditemukan'
        ];

        if (!empty($data)) {
            return $response1;
        } else {
            return $response2;
        }
    }

    public function actionInputFormByUnit()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tindakan=Yii::$app->request->post('tindakannya');
        $unit=Yii::$app->request->post('unitId');

        // alert($unit);

        // print_r('unit',$unit);die;
        $model = new MedisTarifTindakanUnit();
        $data = $model->getTarifTindakanByUnit($tindakan,$unit);

        $response1 = [
            'con' => true,
            'result' => $data,
            'message' => 'Sukses'
        ];
        
        $response2 = [
            'con' => false,
            'message' => 'Data Tidak Ditemukan',
            // 'result'    =>
        ];

        if (!empty($data)) {
            return $response1;
        } else {
            return $response2;
        }
    }
    
    public function actionInputFormByUnitKelas()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tindakan=Yii::$app->request->post('tindakannya');
        $unit=Yii::$app->request->post('unitId');
        $kelas=Yii::$app->request->post('kelasId');

        // print_r('kelas',$kelas);
        $model = new MedisTarifTindakanUnit();
        $data = $model->getTarifTindakanByUnitKelas($tindakan,$unit,$kelas);

        $response1 = [
            'con' => true,
            'result' => $data,
            'message' => 'Sukses'
        ];
        
        $response2 = [
            'con' => false,
            'message' => 'Data Tidak Ditemukan',
            // 'result'    =>
        ];

        if (!empty($data)) {
            return $response1;
        } else {
            return $response2;
        }
    }

    public function actionInputData()
    { 
        Yii::$app->response->format = Response::FORMAT_JSON;
   
        $tarif_tindakan_id = Yii::$app->request->post('tindakan_id');
        $kelas = Yii::$app->request->post('kelas');
        $unitId = Yii::$app->request->post('unit_id');

        $modelTarifTindakan = new MedisTarifTindakan();

        // print_r($kelas);die;

        if($kelas == 'all'){

            

        }else{

        }

        $getTarifTindakanId = $modelTarifTindakan->find()->where(['and',['tindakan_id' => $tarif_tindakan_id],['kelas_rawat_kode'=>$kelas]])->one();

        // echo '<pre>';
        // print_r($getTarifTindakanId);die;
       
        $response1 = [
            'con' => false,
            'result' => $getTarifTindakanId,
            'message' => 'data kosong'
        ];

        $response2 = [
            'con' => true,
            'result' => $getTarifTindakanId,
            'message' => 'sukses'
        ];

        
        if (!empty($getTarifTindakanId)) {
            $model = new MedisTarifTindakanUnit();

            $getLastId = MedisTarifTindakanUnit::find()->select('MAX(id)')->scalar();


            $model->id = $getLastId + 1;
            $model->tarif_tindakan_id   = $getTarifTindakanId->id;
            $model->unit_id             = $unitId;
            $model->aktif               = 1;
            $model->is_deleted          = 0;
            $model->created_by          = Yii::$app->user->identity->id;

            // echo '<pre>';
            // print_r($model->id);die;

            $model->save();

            return $response2;

        } else {
            return $response1;
        }      

    }
    

    public function actionDeleteData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id=Yii::$app->request->post('id');

        $model = $this->findModel($id);
         
        $model->is_deleted = 1;

        $model->save();
    }

}
