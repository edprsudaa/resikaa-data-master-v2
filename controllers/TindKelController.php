<?php

namespace app\controllers;

use app\components\Helper;
use app\models\MedisMasterTindakan;
use yii\filters\AccessControl;
use app\models\MedisTindakan;
use Yii;
use app\models\TindKel;
use app\models\TindKelas;
use app\models\TindKelSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * TindKelController implements the CRUD actions for TindKel model.
 */
class TindKelController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all TindKel models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TindKelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TindKel model.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @return mixed
     */
    public function actionView($KDKEL, $KODE1, $KODE2)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "TindKel #".$KDKEL, $KODE1, $KODE2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($KDKEL, $KODE1, $KODE2),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','KDKEL, $KODE1, $KODE2'=>$KDKEL, $KODE1, $KODE2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($KDKEL, $KODE1, $KODE2),
            ]);
        }
    }

    /**
     * Creates a new TindKel model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TindKel(); 
        $model_kelas = new TindKelas(); 
        $tindkel = $model->getTinkel();
        // echo "<pre>";
        // print_r($tindkel);
        // die;
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new TindKel",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'tindkel' => $tindkel,
                        'model_kelas' => $model_kelas,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $data_tindkel = $_POST['TindKel'];
                $data = $_POST['TindKelas'];
                // var_dump($data);
                // exit;
                $model_kelas->KDKEL = $data_tindkel['KDKEL'];
                $model_kelas->KODE1 = $data_tindkel['KODE1'];
                $model_kelas->KODE2 = $data_tindkel['KODE2'];

                $model_kelas->KodeKelas = $data['KodeKelas'];
                $model_kelas->Harga_Bhn = $data['Harga_Bhn'];
                $model_kelas->Js_RS = $data['Js_RS'];
                $model_kelas->Js_MedRS = $data['Js_MedRS'];
                $model_kelas->Js_MedL = $data['Js_MedL'];
                $model_kelas->Js_MedTL = $data['Js_MedTL'];
                $model_kelas->Js_KSO = $data['Js_KSO'];
                $model_kelas->lPilih = 0;
                
                if($model_kelas->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Create new TindKel",
                        'content'=>'<span class="text-success">Create TindKel success</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ]; 
                }else{
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Create new TindKel",
                        'content'=>'<span class="text-success">Gagal Menyimpan Data</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ]; 
                }       
            }else{           
                return [
                    'title'=> "Create new TindKel",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'tindkel' => $tindkel,
                        'model_kelas' => $model_kelas,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'KDKEL' => $model->KDKEL, 'KODE1' => $model->KODE1, 'KODE2' => $model->KODE2]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'tindkel' => $tindkel,
                    'model_kelas' => $model_kelas,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TindKel model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @return mixed
     */
    public function actionUpdate($KDKEL, $KODE1, $KODE2)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($KDKEL, $KODE1, $KODE2);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update TindKel #".$KDKEL, $KODE1, $KODE2,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "TindKel #".$KDKEL, $KODE1, $KODE2,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','KDKEL, $KODE1, $KODE2'=>$KDKEL, $KODE1, $KODE2],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update TindKel #".$KDKEL, $KODE1, $KODE2,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'KDKEL' => $model->KDKEL, 'KODE1' => $model->KODE1, 'KODE2' => $model->KODE2]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing TindKel model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @return mixed
     */
    // public function actionDelete($KDKEL, $KODE1, $KODE2)
    // {
    //     $request = Yii::$app->request;
    //     $this->findModel($KDKEL, $KODE1, $KODE2)->delete();

    //     if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         return $this->redirect(['index']);
    //     }


    // }

     /**
     * Delete multiple existing TindKel model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @return mixed
     */
    // public function actionBulkDelete()
    // {        
    //     $request = Yii::$app->request;
    //     $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
    //     foreach ( $pks as $pk ) {
    //         $model = $this->findModel($pk);
    //         $model->delete();
    //     }

    //     if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         return $this->redirect(['index']);
    //     }
       
    // }

    /**
     * Finds the TindKel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @return TindKel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($KDKEL, $KODE1, $KODE2)
    {
        if (($model = TindKel::findOne(['KDKEL' => $KDKEL, 'KODE1' => $KODE1, 'KODE2' => $KODE2])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDataTindkel(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = TindKel::find()->where(['KDKEL'=>$_POST['kode']])->andwhere(['lNonAktif'=> 0])->orderBy(['KODE1' => SORT_DESC])->asArray()->one();
        return $data;
    }

    public function actionMappingKodeJenis()
    {
        $tindakan = MedisTindakan::getTindakanAnak();
        
        // var_dump($tindakan);
        // exit();

        // echo "<pre>";
        // print_r($tindakan);
        // die;
        return $this->render('mapping_kode_jenis', [
            'tindakan' => $tindakan,
        ]);
    }

    function actionFormMapping()
    {
        $req = Yii::$app->request;
        
        if ($req->isAjax) {
            $ID = $req->POST('ID');
            $dt_tindakan = MedisTindakan::find()->where(['id' => $ID])->asArray()->one();
            $data_tindkel = TindKel::getKodeJenis();
            // SELECT KELOMPOK, TINDAKAN, KDKEL + KODE1 + KODE2 as kode_jenis FROM RS_AASimrs.dbo.TindKel WHERE lNonAktif=0;

            $model = new MedisTindakan();

            $model->id = $dt_tindakan['id'];
            //$model->deskripsi = $dt_tindakan['deskripsi'];
            // Kode 0 menandakan edit

            return $this->renderAjax('form_mapping_kode_jenis', [
                'model' => $model,
                'dt_tindakan' => $dt_tindakan,
                'data_tindkel' => $data_tindkel,
            ]);
        } else {
            throw new Exception("Illegal access");
        }
    }

    function actionSave()
    {
        $req = Yii::$app->request;
        if ($req->isAjax) {

            $Data = $_POST['MedisTindakan'];

            $query = MedisTindakan::find()->where(['id' => $Data['id']])->one();

            $query->kode_jenis = $Data['kode_jenis'];

            if ($query->validate()) {
                if ($query->save(false)) {
                    $result = [
                        'status' => 'true', 'msg' => 'Mapping Kode Jenis BERHASIL diubah'
                    ];
                } else {
                    $result = ['status' => 'false', 'msg' => 'Mapping Kode Jenis GAGAL diubah'];
                }
            } else {
                $result = ['status' => 'false', 'msg' => $query->errors];
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;
        }
    }

    public function actionListtindakan2()
    {
        //Januari-Desember 2019
        error_reporting(E_ALL ^ E_NOTICE);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        // $connection=Yii::$app->db;
        // SELECT 
        //     DISTINCT tl.KDKEL,tl.KELOMPOK,tl.KDKEL+tl.KODE1+tl.KODE2 as KODETINDAKAN,tl.TINDAKAN,(ts.HARGA_BHN+ts.JS_RS+ts.JS_MEDRS+ts.JS_MEDL+ts.JS_MEDTL+ts.JS_KSO) AS BIAYA
        // FROM
        // ".TindKel::tableName()." tl LEFT JOIN ".TindKelas::tableName()." ts ON tl.KDKEL=ts.KDKEL AND tl.KODE1=ts.KODE1 AND tl.KODE2=ts.KODE2
        // WHERE
        // tl.lNonAktif=0 AND tl.lHeader=0 AND tl.KDKEL in ('ZU', 'ZV', 'ZW', 'ZX', 'ZZ') AND tl.KELOMPOK not in ('SPESIALIS ANAK', 'Tindakan  Orthodonti')
        $sql="
        SELECT 
            DISTINCT tl.KDKEL,tl.KELOMPOK,tl.KDKEL+tl.KODE1+tl.KODE2 as KODETINDAKAN,tl.TINDAKAN,(ts.HARGA_BHN+ts.JS_RS+ts.JS_MEDRS+ts.JS_MEDL+ts.JS_MEDTL+ts.JS_KSO) AS BIAYA
        FROM
        ".TindKel::tableName()." tl LEFT JOIN ".TindKelas::tableName()." ts ON tl.KDKEL=ts.KDKEL AND tl.KODE1=ts.KODE1 AND tl.KODE2=ts.KODE2
        WHERE
            tl.lNonAktif=0 AND tl.lHeader=0
        ORDER BY tl.KDKEL ASC
        ";
        $data=Yii::$app->dbSimrsOld->createCommand($sql)->queryAll();
        // echo'<pre/>';print_r($pelayanan_dok);die();
        echo'<table border="1" style="border-collapse:collapse"><thead><tr><th>No</th><th>Kode Kelompok</th><th>Nama Kelompok</th><th>Kode Tindakan</th><th>Nama Tindakan</th><th>Tarif</th></tr><thead/>';
        echo'<tbody>';
        $noUrut = 1;
        foreach($data AS $val){
            if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI'){
                $kelompok = 5340;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI - PERACIK OBAT KEMOTERAPI'){
                $kelompok = 5341;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI - SUPIR'){
                $kelompok = 5342;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI - TERPAJAN DEBU DAN ASAP'){
                $kelompok = 5343;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI - TERPAJAN GAS ANASTESI'){
                $kelompok = 5344;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI - TERPAJAN KEBISINGAN'){
                $kelompok = 5345;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI - TIDAK KONTAK DENGAN PASIEN'){
                $kelompok = 5346;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PEGAWAI -TERPAJAN RADIASI'){
                $kelompok = 5347;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP LABORATORIUM PATOLOGI ANATOMI'){
                $kelompok = 5348;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP LABORATORIUM PATOLOGI KLINIK'){
                $kelompok = 5349;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET A'){
                $kelompok = 5350;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET B'){
                $kelompok = 5351;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET C'){
                $kelompok = 5352;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET CALON PRAJA PRIA IPDN'){
                $kelompok = 5353;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET CALON PRAJA WANITA IPDN'){
                $kelompok = 5354;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET D'){
                $kelompok = 5355;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET KHUSUS'){
                $kelompok = 5356;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PELAUT'){
                $kelompok = 5357;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PILKADA'){
                $kelompok = 5358;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET SPAMEN'){
                $kelompok = 5359;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET TKI MALAYSIA'){
                $kelompok = 5360;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PEMERIKSAAN RADIODIAGNOSTIK'){
                $kelompok = 5361;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP TINDAKAN MEDIK NON OPERATIF'){
                $kelompok = 5362;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP TINDAKAN MEDIK OPERATIF (IBS)'){
                $kelompok = 5363;
            }else if($val['KELOMPOK']=='MCU DI LUAR PAKET'){
                $kelompok = 5364;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET A'){
                $kelompok = 5365;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET B'){
                $kelompok = 5366;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET C'){
                $kelompok = 5367;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET CALON PRAJA IPDN.'){
                $kelompok = 5368;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET CALON PRAJA PRIA IPDN'){
                $kelompok = 5369;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET CALON PRAJA WANITA IPDN'){
                $kelompok = 5370;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET D'){
                $kelompok = 5371;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET KEJAKSAAN RI'){
                $kelompok = 5372;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET KHUSUS'){
                $kelompok = 5373;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET KPU PRIA'){
                $kelompok = 5374;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET KPU WANITA'){
                $kelompok = 5375;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PELAUT'){
                $kelompok = 5376;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PILKADA'){
                $kelompok = 5377;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PIMPINAN/ANGGOTA/KELUARGA DP'){
                $kelompok = 5378;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET SPAMEN'){
                $kelompok = 5379;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET TKI MALAYSIA'){
                $kelompok = 5380;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP SMK KEHUTANAN'){
                $kelompok = 5381;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP TAMBAHAN DILUAR PAKET'){
                $kelompok = 5382;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP PAKET PILKADA 2020'){
                $kelompok = 5383;
            }else if($val['KELOMPOK']=='MEDICAL CHECKUP BNI 2021'){
                $kelompok = 5384;
            }
            // $model = NEW MedisMasterTindakan();
            // $model->parent_id = $kelompok;
            // $model->deskripsi = $val['TINDAKAN'];
            // $model->kode_jenis = $val['KODETINDAKAN'];
            // $model->is_active = 1;
            // $model->created_by = 1;
            // $model->created_at = '2022-02-10 16:30:48.000';
            // $model->save();
            echo'<tr><td>'.$noUrut.'</td><td>'.$val['KDKEL'].'</td><td>'.$kelompok.'</td><td>'.$val['KODETINDAKAN'].'</td><td>'.$val['TINDAKAN'].'</td><td>'.intval($val['BIAYA']).'</td></tr>';
        $noUrut++;
        }
        echo'</tbody>';
        echo'</table>';
        die();
    }
}