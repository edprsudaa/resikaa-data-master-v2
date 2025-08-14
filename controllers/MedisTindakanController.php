<?php

namespace app\controllers;

use Yii;
use Exception;
use yii\web\Response;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\MedisTindakan;
use PhpOffice\PhpSpreadsheet;
use yii\filters\AccessControl;
use app\models\MedisTarifTindakan;
use aryelds\sweetalert\SweetAlert;
use yii\web\NotFoundHttpException;
use app\models\MedisTindakanSearch;
use yii\validators\UniqueValidator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use app\models\MedisTarifTindakanSearch;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

/**
 * MedisTindakanController implements the CRUD actions for MedisTindakan model.
 */
class MedisTindakanController extends Controller
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
     * Lists all MedisTindakan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisTindakanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        

        // $mod_tindakan = new MedisTindakan();
        $model              = new MedisTindakan();
        $tindakan = $model->getTindakanInduk();


        $tindakanMedis           = $model->getTindakan();
        $dataParent         = $model->getParentId();
        $skTarifTindakan    = $model->getSkTarifTindakan();
        $kelasRawat         = $model->getKelasRawat();
        $modelTarifTindakan = new MedisTarifTindakan();

        // $getlastInsertId    = $model->find()->max('id');
        // $id                 = $getlastInsertId +1;


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tindakan' => $tindakan,
            'model'                 => $model,
            'tindakanMedis'              => $tindakanMedis,
            'dataParent'            => $dataParent,
            'modelTarifTindakan'    => $modelTarifTindakan,
            'skTarifTindakan'       => $skTarifTindakan,
            'kelasRawat'            => $kelasRawat,
        ]);
    }

    /**
     * Displays a single MedisTindakan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        $getIdParent   = MedisTindakan::getIdParentTindakan($id);
        $getNamaParent = MedisTindakan::getParentTindakan($getIdParent->parent_id);

        // print_r($getNamaParent);die;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'namaParent' =>$getNamaParent
        ]);
    }

    /**
     * Creates a new MedisTindakan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_()
    {
        $model              = new MedisTindakan();
        $tindakan           = $model->getTindakan();
        $dataParent         = $model->getParentId();
        $skTarifTindakan    = $model->getSkTarifTindakan();
        $kelasRawat         = $model->getKelasRawat();
        $modelTarifTindakan = new MedisTarifTindakan();

        $getlastInsertId    = $model->find()->max('id');
        $id                 = $getlastInsertId +1;

        

        if ($model->load(Yii::$app->request->post()) ) {
            // echo '<pre>';
            // print_r($model->toArray());die;


            $cekKodeJenis   = $model->find()->where(['kode_jenis' => $model->kode_jenis])->count();

            if ($cekKodeJenis > 0) {
                Yii::$app->session->setFlash('danger', 'Maaf, Kode Jenis Telah Digunakan.');
            }else{
                $model->aktif   = 1;
                $model->id      = $id;

                foreach ($model->deskripsi as $deskripsi) {
                    $create[] = [$id++,$model->parent_id,$deskripsi['deskripsi'],$deskripsi['kode_jenis'], date('y-m-d H:i:s'),Yii::$app->user->identity->id];
                }

                Yii::$app->db->createCommand()->batchInsert(MedisTindakan::tableName(), ['id','parent_id', 'deskripsi', 'kode_jenis','created_at','created_by'],$create)->execute();
                //  Yii::$app->session->setFlash('success', 'Data Berhasil Ditambah.');
                   Yii::$app->getSession()->setFlash('success', [
                        // 'text' => 'My custom text',
                        'title' => 'Berhasil Tambah Data',
                        'type' => 'success',
                        'timer' => 3000,
                        'showConfirmButton' => true
                    ]);
                return $this->redirect(['view', 'id' => $model->id]);
                // if($model->save()){
                   
                // }
            }
            
           
        }

        return $this->render('create', [
            'model'                 => $model,
            'tindakan'              => $tindakan,
            'dataParent'            => $dataParent,
            'modelTarifTindakan'    => $modelTarifTindakan,
            'skTarifTindakan'       => $skTarifTindakan,
            'kelasRawat'            => $kelasRawat,
        ]);
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = [];
             
        foreach (Yii::$app->request->post('kelas')  as $kelas) {
               
                
            $model = new MedisTarifTindakan();
            $model->kelas_rawat_kode        = $kelas;
            $model->id                      = $model->find()->max('id') + 1;
            $model->tindakan_id             = Yii::$app->request->post('idTindakan');
            $model->sk_tarif_id             = Yii::$app->request->post('skTarif');
            $model->js_adm                  = Yii::$app->request->post('jsAdministrasi');
            $model->js_sarana               = Yii::$app->request->post('jsSarana');
            $model->js_bhp                  = Yii::$app->request->post('jsBHP');
            $model->js_dokter_operator      = Yii::$app->request->post('jsDokterOperator');
            $model->js_dokter_lainya        = Yii::$app->request->post('jsDokterLainnya');
            $model->js_dokter_anastesi      = Yii::$app->request->post('jsDokterAnastesi');
            $model->js_penata_anastesi      = Yii::$app->request->post('jsPenataAnastesi');
            $model->js_paramedis            = Yii::$app->request->post('jsParamedis');
            $model->js_lainya               = Yii::$app->request->post('jsLainnya');

            $model->js_adm_cto              = Yii::$app->request->post('jsAdministrasiCto');
            $model->js_sarana_cto           = Yii::$app->request->post('jsSaranaCto');
            $model->js_bhp_cto              = Yii::$app->request->post('jsBHPCto');
            $model->js_dokter_operator_cto  = Yii::$app->request->post('jsDokterOperatorCto');
            $model->js_dokter_lainya_cto    = Yii::$app->request->post('jsDokterLainnyaCto');
            $model->js_dokter_anastesi_cto  = Yii::$app->request->post('jsDokterAnastesiCto');
            $model->js_penata_anastesi_cto  = Yii::$app->request->post('jsPenataAnastesiCto');
            $model->js_paramedis_cto        = Yii::$app->request->post('jsParamedisCto');
            $model->js_lainya_cto           = Yii::$app->request->post('jsLainnyaCto');
            $model->created_by              = Yii::$app->user->identity->id;
            $model->is_deleted              = 0;

            $model->save();

            if ($model->hasErrors()) {
                // Add error message to response array
                $response[] = [
                    'success' => false,
                    'message' => 'Data Gagal Ditambahkan.',
                    'data' => $model->getErrors(),
                ];
            } else {
                // Add success message to response array
                $response[] = [
                    'success' => true,
                    'message' => 'Data Berhasil Ditambah.',
                    'data' => $model,
                ];
            }
        }     

        return $response;
   
       
    }

    /**
     * Updates an existing MedisTindakan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model              = $this->findModel($id);

        $model->deskripsi = Yii::$app->request->post('deskripsi') !== null ? Yii::$app->request->post('deskripsi') : $model->deskripsi;
        $model->parent_id = Yii::$app->request->post('parent') !== null ? Yii::$app->request->post('parent') : $model->parent_id;
        $model->aktif     = Yii::$app->request->post('aktif') !== null ? Yii::$app->request->post('aktif') : $model->aktif;
        $model->kode_jenis= Yii::$app->request->post('kode_jenis') !== null ? Yii::$app->request->post('kode_jenis') : $model->kode_jenis;
       
        // echo '<pre>';
        // print_r($model);
        // die;

        if ($model->save()) {
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
     * Deletes an existing MedisTindakan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id);
         
        $model->is_deleted ='1';

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
     * Finds the MedisTindakan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisTindakan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisTindakan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFormTindakan($id)
    {
        $model              = new MedisTarifTindakan();
        $dataMedisTindakan  = MedisTindakan::getMedisTindakan($id);
        $kelasRawat         = MedisTindakan::getKelasRawat();
        $skTarifTindakan    = MedisTindakan::getSkTarifTindakan();
        

        // echo '<pre>';
        // print_r($dataMedisTindakan);die;

        return $this->render('form-tarif-tindakan',[
            'model'                 => $model,
            'dataMedisTindakan'     => $dataMedisTindakan,
            'skTarifTindakan'       => $skTarifTindakan,
            'kelasRawat'            => $kelasRawat,
        ]);
    }

    public function actionAddFormTindakan()
    {

        $req = Yii::$app->request;
        if ($req->isAjax) {

              
        $model              = new MedisTindakan();
        $tindakan           = $model->getTindakan();
        $dataParent         = $model->getParentId();
        $skTarifTindakan    = $model->getSkTarifTindakan();
        $kelasRawat         = $model->getKelasRawat();
        $modelTarifTindakan = new MedisTarifTindakan();

         return $this->renderAjax('form-add-tindakan', [
            'model'                 => $model,
            'tindakan'              => $tindakan,
            'dataParent'            => $dataParent,
            'modelTarifTindakan'    => $modelTarifTindakan,
            'skTarifTindakan'       => $skTarifTindakan,
            'kelasRawat'            => $kelasRawat,
        ]);
           
        } else {
            throw new Exception("Illegal access");
        }

      
    }

    public function actionSaveMedisTindakan()
    {
        $parent     = Yii::$app->request->post('parent');
        $kode_jenis = Yii::$app->request->post('kode_jenis');
        $deskripsi  = Yii::$app->request->post('deskripsi');

        $model              = new MedisTindakan();
        $model->parent_id   = $parent;
        $model->kode_jenis  = $kode_jenis;
        $model->deskripsi   = $deskripsi;

        $tindakan           = $model->getTindakan();
        $dataParent         = $model->getParentId();
        $skTarifTindakan    = $model->getSkTarifTindakan();
        $kelasRawat         = $model->getKelasRawat();
        $modelTarifTindakan = new MedisTarifTindakan();

        $getlastInsertId    = $model->find()->max('id');
        $id                 = $getlastInsertId +1;
         
        $cekKodeJenis   = $model->find()->where(['kode_jenis' => $kode_jenis])->count();

        if ($cekKodeJenis > 0) {
            Yii::$app->getSession()->setFlash('success', [
                'title' => 'Maaf, Kode Jenis Telah Digunakan.',
                'type' => SweetAlert::TYPE_ERROR,
                'showConfirmButton' => true
            ]);
        }else{
            $model->aktif   = 1;
            $model->id      = $id;
            // echo '<pre>';
            // print_r($model);die;
            
            $model->save();

            Yii::$app->getSession()->setFlash('success', [
                'title' => 'Data Medis Tindakan Berhasil Ditambah.',
                'type' => SweetAlert::TYPE_SUCCESS,
                'timer' => 4000,
                'showConfirmButton' => true
            ]);

             return $this->redirect(['medis-tindakan/index']);
            
        }

    }

    function actionFormImport($id)
    {
        $model = new MedisTindakan();
        $model->scenario = 'importFile';
        //$model->scenario = MedisTindakan::SCENARIO_IMPORT;

        if ($model->load(Yii::$app->request->post()) ) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if($model->importFile != null){
                $filename = 'IMPORT-TINDAKAN';
                $path = \Yii::getAlias('@webroot/berkas/'.$filename.'.'.$model->importFile->extension);
                $uploaded = $model->importFile->saveAs($path);
                if($uploaded){
                    // Mengidentifikasi Filename
                    $readerType = IOFactory::identify($path);
                    // Membaca Filename berdasarkan Type File
                    $objReader = IOFactory::createReader($readerType);
                    // Meload Filename
                    $objPHPExcel = $objReader->load($path);
                    // Membaca Sheet 1 Array 1
                    $sheet = $objPHPExcel->getSheet(0);
                    // Membaca Banyak Baris Atau baris Terakhir Sheet 2 Array 1
                    $highestRow = $sheet->getHighestRow();
                    // Membaca Kolom Terakhir atau Tertinggi Sheet 2 Array 1
                    $highestColumn = $sheet->getHighestColumn();

                    for($row=3; $row <=$highestRow; $row++){
                        // Membaca Array dari Excel dengan batasan Tertentu Exp : A - Kolom Tertinggi
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        // $model->parent_id = $id;
                        // $model->deskripsi = $rowData[0][0];
                        // $model->aktif = $rowData[0][1];
                        // $model->kode_jenis = $rowData[0][2];
                        // $model->created_by = 1;

                        // var_dump($rowData);
                        // exit;

                        // Insert Data
                        Yii::$app->db->createCommand("
                            INSERT INTO ".MedisTindakan::TableName()." (parent_id, deskripsi, aktif, kode_jenis, created_by) 
                            VALUES (:parid, :desk, :akt, :koje, :creby)", [
                                ':parid'=>$id,
                                ':desk'=>$rowData[0][0],
                                ':akt'=>1,
                                ':koje'=>$rowData[0][2],
                                ':creby'=>1
                            ])->execute();

                        //$model->save();
                    }
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('form-import', [
            'model' => $model,
        ]);
    }

    function actionDownload() {
        $root=Yii::getAlias('@webroot').'/berkas/IMPORT-TINDAKAN.xlsx';
        if (file_exists($root)) {
            return Yii::$app->response->sendFile($root);
        } else {
            throw new NotFoundHttpException("{$root} is not found!");
        }
     }

    function actionAddTarifTindakan($id)
    {
        
        $modelTindakanMedis         = MedisTindakan::getTarifTindakanMedis($id);
        $medisTindakan              = $this->findModel($id);
        $dataMedisTindakan          = MedisTindakan::getMedisTindakan($medisTindakan->parent_id);
        $kelasRawat         = MedisTindakan::getKelasRawat();
        $skTarifTindakan    = MedisTindakan::getSkTarifTindakan();

        $searchModelTarifTindakan = new MedisTarifTindakanSearch();
        $dataProviderTarifTindakan = $searchModelTarifTindakan->searchTarifTindakan(Yii::$app->request->queryParams, $id);       
        

        // echo '<pre>';
        // print_r($kodeKelasRawat->kelas_rawat_kode);
        // die;
        return $this->render('tarif-tindakan',[
            'modelTindakanMedis'        => $modelTindakanMedis,
            'dataMedisTindakan'         => $dataMedisTindakan,
            'medisTindakan'             => $medisTindakan,
            'searchModelTarifTindakan'  => $searchModelTarifTindakan,
            'dataProviderTarifTindakan' => $dataProviderTarifTindakan,
            'kelasRawat'                => $kelasRawat,
            'skTarifTindakan'           => $skTarifTindakan,
        ]);
    }

    function actionSaveTarifTindakan()
    {

        $idTindakan = Yii::$app->request->post('idTindakan');
        $skTarif = Yii::$app->request->post('idSkTarif');
        $kelasRawat = Yii::$app->request->post('kelasRawatKode');
        $js_adm = Yii::$app->request->post('js_adm');
        $js_sarana = Yii::$app->request->post('js_sarana');
        $js_bhp = Yii::$app->request->post('js_bhp');
        $js_dokter_operator = Yii::$app->request->post('js_dokter_operator');
        $js_dokter_lainya = Yii::$app->request->post('js_dokter_lainnya');
        $js_dokter_anastesi = Yii::$app->request->post('js_dokter_anastesi');
        $js_penata_anastesi = Yii::$app->request->post('js_penata_anastesi');
        $js_paramedis = Yii::$app->request->post('js_paramedis');
        $js_lainya = Yii::$app->request->post('js_lainya');
        
        $js_adm_cto = Yii::$app->request->post('js_adm_cto');
        $js_sarana_cto = Yii::$app->request->post('js_sarana_cto');
        $js_bhp_cto = Yii::$app->request->post('js_bhp_cto');
        $js_dokter_operator_cto = Yii::$app->request->post('js_dokter_operator_cto');
        $js_dokter_lainya_cto = Yii::$app->request->post('js_dokter_lainya_cto');
        $js_dokter_anastesi_cto = Yii::$app->request->post('js_dokter_anastesi_cto');
        $js_penata_anastesi_cto = Yii::$app->request->post('js_penata_anastesi_cto');
        $js_paramedis_cto = Yii::$app->request->post('js_paramedis_cto');
        $js_lainya_cto = Yii::$app->request->post('js_lainya_cto');

        $model      = new MedisTarifTindakan();

        $model->tindakan_id         = $idTindakan;
        $model->kelas_rawat_kode    = $kelasRawat;
        $model->sk_tarif_id         = $skTarif;
        $model->js_adm              = $js_adm;
        $model->js_sarana           = $js_sarana;
        $model->js_bhp              = $js_bhp;
        $model->js_dokter_operator  = $js_dokter_operator;
        $model->js_dokter_lainya    = $js_dokter_lainya;
        $model->js_dokter_anastesi  = $js_dokter_anastesi;
        $model->js_penata_anastesi  = $js_penata_anastesi;
        $model->js_paramedis        = $js_paramedis;
        $model->js_lainya           = $js_lainya;
        $model->js_adm_cto          = $js_adm_cto;
        $model->js_sarana_cto       = $js_sarana_cto;
        $model->js_bhp_cto          = $js_bhp_cto;
        $model->js_dokter_operator_cto   = $js_dokter_operator_cto;
        $model->js_dokter_lainya_cto     = $js_dokter_lainya_cto;
        $model->js_dokter_anastesi_cto   = $js_dokter_anastesi_cto;
        $model->js_penata_anastesi_cto   = $js_penata_anastesi_cto;
        $model->js_paramedis_cto         = $js_paramedis_cto;
        $model->js_lainya_cto            = $js_lainya_cto;

        $model->created_by  = Yii::$app->user->identity->id;
        $model->is_deleted = 0;

        //cek duplikate kelas rawat 
        $modelTindakanMedis = MedisTarifTindakan::find()->where(['tindakan_id' => $idTindakan])->one();
        $cekKelasRawat      = MedisTarifTindakan::find()->alias('a')->where(['and',['kelas_rawat_kode' => $kelasRawat],['tindakan_id' =>$idTindakan],['<>','a.is_deleted',1]])->count();

        if ($cekKelasRawat > 0) {
            // Yii::$app->session->setFlash('danger', 'Kelas Rawat Tersebut Telah Tersedia, silakan Cek Kembali.');
             Yii::$app->getSession()->setFlash('success', [
                // 'text' => 'Berhasil Hapus Data1',
                'title' => 'Kelas Rawat Tersebut Telah Tersedia, silakan Cek Kembali.',
                'type' => SweetAlert::TYPE_ERROR,
                'timer' => 3000,
                'showConfirmButton' => true
            ]);
            return $this->redirect(['add-tarif-tindakan', 'id' => $idTindakan]);
        }else{
            // echo '<pre>';
            // print_r($cekKelasRawat);die;

            $model->save();
             Yii::$app->getSession()->setFlash('success', [
                        // 'text' => 'Berhasil Hapus Data1',
                        'title' => 'Data Berhasil Ditambah.',
                        'type' => 'success',
                        'timer' => 3000,
                        'showConfirmButton' => true
                    ]);
            // Yii::$app->session->setFlash('success', 'Data Berhasil Ditambah.');
            return $this->redirect(['add-tarif-tindakan', 'id' => $idTindakan]);
        }


        
    }

    function actionUpdateTarifTindakan()
    {

        $id = Yii::$app->request->post('idTarif');
        $skTarif = Yii::$app->request->post('idSkTarif');
        $kelasRawat = Yii::$app->request->post('kelasRawatKode');
        $js_adm = Yii::$app->request->post('js_adm');
        $js_sarana = Yii::$app->request->post('js_sarana');
        $js_bhp = Yii::$app->request->post('js_bhp');
        $js_dokter_operator = Yii::$app->request->post('js_dokter_operator');
        $js_dokter_lainya = Yii::$app->request->post('js_dokter_lainnya');
        $js_dokter_anastesi = Yii::$app->request->post('js_dokter_anastesi');
        $js_penata_anastesi = Yii::$app->request->post('js_penata_anastesi');
        $js_paramedis = Yii::$app->request->post('js_paramedis');
        $js_lainya = Yii::$app->request->post('js_lainya');
        
        $js_adm_cto = Yii::$app->request->post('js_adm_cto');
        $js_sarana_cto = Yii::$app->request->post('js_sarana_cto');
        $js_bhp_cto = Yii::$app->request->post('js_bhp_cto');
        $js_dokter_operator_cto = Yii::$app->request->post('js_dokter_operator_cto');
        $js_dokter_lainya_cto = Yii::$app->request->post('js_dokter_lainya_cto');
        $js_dokter_anastesi_cto = Yii::$app->request->post('js_dokter_anastesi_cto');
        $js_penata_anastesi_cto = Yii::$app->request->post('js_penata_anastesi_cto');
        $js_paramedis_cto = Yii::$app->request->post('js_paramedis_cto');
        $js_lainya_cto = Yii::$app->request->post('js_lainya_cto');

        $model      = MedisTarifTindakan::find()->where(['id'=>$id])->one();

        $model->kelas_rawat_kode    = $kelasRawat;
        $model->sk_tarif_id         = $skTarif;
        $model->js_adm              = $js_adm;
        $model->js_sarana           = $js_sarana;
        $model->js_bhp              = $js_bhp;
        $model->js_dokter_operator  = $js_dokter_operator;
        $model->js_dokter_lainya    = $js_dokter_lainya;
        $model->js_dokter_anastesi  = $js_dokter_anastesi;
        $model->js_penata_anastesi  = $js_penata_anastesi;
        $model->js_paramedis        = $js_paramedis;
        $model->js_lainya           = $js_lainya;
        $model->js_adm_cto          = $js_adm_cto;
        $model->js_sarana_cto       = $js_sarana_cto;
        $model->js_bhp_cto          = $js_bhp_cto;
        $model->js_dokter_operator_cto   = $js_dokter_operator_cto;
        $model->js_dokter_lainya_cto     = $js_dokter_lainya_cto;
        $model->js_dokter_anastesi_cto   = $js_dokter_anastesi_cto;
        $model->js_penata_anastesi_cto   = $js_penata_anastesi_cto;
        $model->js_paramedis_cto         = $js_paramedis_cto;
        $model->js_lainya_cto            = $js_lainya_cto;

        $model->updated_by  = Yii::$app->user->identity->id;
        $model->updated_at  =  date('Y-m-d H:i:s');
        // $model->is_deleted = 0;

        //cek duplikate kelas rawat 
        $modelTindakanMedis = MedisTarifTindakan::find()->where(['id' => $id])->one();

        

        $cekKelasRawat      = MedisTarifTindakan::find()->alias('a')->where(['and',['kelas_rawat_kode' => $kelasRawat],['tindakan_id' =>$modelTindakanMedis->tindakan_id],['<>','a.is_deleted',1],['<>','a.id',$id]])->count();
        
       
        if ($cekKelasRawat > 0) {

             Yii::$app->getSession()->setFlash('success', [
                // 'text' => 'Berhasil Hapus Data1',
                'title' => 'Kelas Rawat Tersebut Telah Tersedia, silakan Cek Kembali.',
                'type' => SweetAlert::TYPE_ERROR,
                'timer' => 3000,
                'showConfirmButton' => true
            ]);
            return $this->redirect(['add-tarif-tindakan', 'id' => $modelTindakanMedis->tindakan_id]);
        }else{
            // echo '<pre>';
            // print_r($model);die;

            // $model = $this->findModel($id);

            $model->save();
            // Yii::$app->session->setFlash('success', 'Data Berhasil Diubah.');
            Yii::$app->getSession()->setFlash('success', [
                // 'text' => 'Berhasil Hapus Data1',
                'title' => 'Data Berhasil Diubah.',
                'type' => 'success',
                'timer' => 3000,
                'showConfirmButton' => true
            ]);
            return $this->redirect(['add-tarif-tindakan', 'id' => $modelTindakanMedis->tindakan_id]);
        }


        
    }

   

    public function actionDeleteTarifTindakan()
    {
        $id = Yii::$app->request->post('id');
        $model = MedisTarifTindakan::findOne($id);
        $date = date('Y-m-d H:i:s');
        $model->is_deleted = '1';
        $model->updated_at = $date;
        $model->updated_by  = Yii::$app->user->identity->id;
        
        // echo '<pre>';
        // print_r($model->tindakan_id);die;
        if ($model->save()) {
           
            Yii::$app->getSession()->setFlash('success', [
                // 'text' => 'Berhasil Hapus Data1',
                'title' => 'Data Berhasil Dihapus.',
                'type' => 'success',
                'timer' => 3000,
                'showConfirmButton' => true
            ]);
            return $this->redirect(['add-tarif-tindakan', 'id' => $model->tindakan_id]);
        }
    }
}
