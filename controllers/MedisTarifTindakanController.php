<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\components\Helper;
use app\models\MedisSkTarif;
use Yii;
use app\models\MedisTarifTindakan;
use app\models\MedisTarifTindakanSearch;
use app\models\MedisTindakan;
use app\models\PendaftaranKelasRawat;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * MedisTarifTindakanController implements the CRUD actions for MedisTarifTindakan model.
 */
class MedisTarifTindakanController extends Controller
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
     * Lists all MedisTarifTindakan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisTarifTindakanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tindakan = MedisTindakan::find()->where("id NOT IN (select parent_id from medis.tindakan as d where parent_id is not null group by parent_id)")->all();
        $kelas_rawat = PendaftaranKelasRawat::find()->all();
        $sk_tarif = MedisSkTarif::find()->all();

        $mod_tindakan = new MedisTindakan();
        $referensi = $mod_tindakan->getTindakanAnak();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tindakan' => $tindakan,
            'kelas_rawat' => $kelas_rawat,
            'sk_tarif' => $sk_tarif,
            'referensi' => $referensi,
        ]);
    }

    /**
     * Displays a single MedisTarifTindakan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

     public function actionGetTarifTindakan($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $modelTindakanMedis          = MedisTarifTindakan::getTarifTindakanMedis($id);

        return $modelTindakanMedis;        

    }
    public function actionView($id)
    {   
        // $bookSelected =[
        //     'id'=>1,
        //     'name'=>'aw'
        // ];

        //  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $books = [
        //     ['id'=>'1','title'=>'Pemrograman PHP','author'=>'Hafid','year'=>'2015'],
        //     ['id'=>'2','title'=>'Pemrograman JS','author'=>'Juned','year'=>'2014'],
        //     ['id'=>'3','title'=>'Database MySQL','author'=>'Lily','year'=>'2013'],
        // ];
	    // // Jika menggunakan basis data maka:
        // // $books = Book::find()->asArray()->all();
        // return $books;


        // return [
        //     'book' => $bookSelected,
        // ];
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    

    

    /**
     * Creates a new MedisTarifTindakan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisTarifTindakan();
        $kelas_rawat = PendaftaranKelasRawat::find()->all();
        $sk_tarif = MedisSkTarif::find()->all();
        $q = Yii::$app->request;
        if ($model->load($q->post())) {
            $model->created_by = 1;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->js_adm = 0;
            $model->js_sarana = 0;
            $model->js_bhp = 0;
            $model->js_dokter_operator = 0;
            $model->js_dokter_lainya = 0;
            $model->js_dokter_anastesi = 0;
            $model->js_penata_anastesi = 0;
            $model->js_paramedis = 0;
            $model->js_lainya = 0;

            $model->js_adm_cto = 0;
            $model->js_sarana_cto = 0;
            $model->js_bhp_cto = 0;
            $model->js_dokter_operator_cto = 0;
            $model->js_dokter_lainya_cto = 0;
            $model->js_dokter_anastesi_cto = 0;
            $model->js_penata_anastesi_cto = 0;
            $model->js_paramedis_cto = 0;
            $model->js_lainya_cto = 0;
        }

        return $this->render('create', [
            'model' => $model,
            'kelas_rawat' => $kelas_rawat,
            'tindakan' => [],
            'sk_tarif' => $sk_tarif,
        ]);
    }

    /**
     * Updates an existing MedisTarifTindakan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tindakan = MedisTindakan::find()->where("id NOT IN (select parent_id from medis.tindakan as d where parent_id is not null group by parent_id)")->all();
        $kelas_rawat = PendaftaranKelasRawat::find()->all();
        $sk_tarif = MedisSkTarif::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $date = date('Y-m-d H:i:s');
            $model->updated_at = $date;
            $model->updated_by = 1;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'tindakan' => $tindakan,
            'kelas_rawat' => $kelas_rawat,
            'sk_tarif' => $sk_tarif,
        ]);
    }

    /**
     * Deletes an existing MedisTarifTindakan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $date = date('Y-m-d H:i:s');
        $model = $this->findModel($id);

        $model->is_deleted = '1';
        $model->updated_at = $date;
        //$model->updated_by = Yii::$app->user->identity->kodeAkun;
        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the MedisTarifTindakan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisTarifTindakan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisTarifTindakan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTindakannya()
    {
        $sk = $_POST['sk'];
        $kelas = $_POST['kelas'];
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get_tarif_tindakan = MedisTarifTindakan::find()
            ->select('tindakan_id')
            ->where(['sk_tarif_id' => $sk])
            ->andwhere(['kelas_rawat_kode' => $kelas])->all();
        // ->createCommand()->getRawSql();
        //var_dump($get_tarif_tindakan);exit;
        // echo "<pre>";
        // print_r($get_tarif_tindakan);
        // die;
        $array_data_tindakan = implode(',', ArrayHelper::getColumn($get_tarif_tindakan, function ($element) {
            return $element['tindakan_id'];
        }));

        // var_dump($get_tarif_tindakan);
        // var_dump($array_data_tindakan);
        // exit;
        if (empty($get_tarif_tindakan)) {
            $data = Yii::$app->db->createCommand("
            SELECT id, deskripsi FROM 
                (SELECT a.id, a.deskripsi FROM " . MedisTindakan::tableName() . " as a 
                WHERE a.id NOT IN (select b.parent_id from " . MedisTindakan::tableName() . " as b where b.parent_id is not null group by b.parent_id)) as x")->queryAll();
        } else {
            $data = Yii::$app->db->createCommand("
            SELECT id, deskripsi FROM 
                (SELECT a.id, a.deskripsi FROM " . MedisTindakan::tableName() . " as a 
                WHERE a.id NOT IN (select b.parent_id from " . MedisTindakan::tableName() . " as b where b.parent_id is not null group by b.parent_id)) as x 
            WHERE id NOT IN ($array_data_tindakan)")->queryAll();
        }

        //$data = ::find()->where(['kode'=>$_POST['kode']])->asArray()->one();
        //var_dump($data);exit;
        // echo "<pre>";
        // print_r($data);
        // die;
        return $data;
    }

    function actionFormExport()
    {
        $req = Yii::$app->request;
        if ($req->isAjax) {

            $sk_tarif = MedisSkTarif::find()->asArray()->all();
            $kelas_rawat = PendaftaranKelasRawat::find()->asArray()->all();
            $mod_tindakan = new MedisTindakan();
            $tindakan = $mod_tindakan->getTindakanInduk();

            // Kode 0 menandakan edit

            return $this->renderAjax('formexport', [
                'sk_tarif' => $sk_tarif,
                'kelas_rawat' => $kelas_rawat,
                'tindakan' => $tindakan,
            ]);
        } else {
            throw new Exception("Illegal access");
        }
    }

    function actionExport()
    {

        $sk = $_POST['sktarif'];
        $kelas = $_POST['kelasrawat'];
        $tindakan = $_POST['tindakan'];
        // var_dump($kelas);
        // exit;

        ini_set("memory_limit", "8056M");
        ini_set('max_execution_time', 0);
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);

        $objPHPExcel = new Spreadsheet();
        $stylehead = array(
            'alignment' => array(
                // 'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'font'  => array(
                'bold'  => true,
                'size'  => 14,
                'name'  => 'Times New Rowman'
            )
        );

        $objPHPExcel->getActiveSheet()->setCellValue('A1', "SK Tarif ID");
        $objPHPExcel->getActiveSheet()->setCellValue('A2', "0");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "Nomor SK");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "1");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "Kode Kelas rawat");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "2");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "Kelas RAwat");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "3");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "ID Tindakan");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "4");
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "Deskripsi");
        $objPHPExcel->getActiveSheet()->setCellValue('F2', "5");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "JS ADM");
        $objPHPExcel->getActiveSheet()->setCellValue('G2', "6");
        $objPHPExcel->getActiveSheet()->setCellValue('H1', "JS Sarana");
        $objPHPExcel->getActiveSheet()->setCellValue('H2', "7");
        $objPHPExcel->getActiveSheet()->setCellValue('I1', "JS BHP");
        $objPHPExcel->getActiveSheet()->setCellValue('I2', "8");
        $objPHPExcel->getActiveSheet()->setCellValue('J1', "JS Dokter Operator");
        $objPHPExcel->getActiveSheet()->setCellValue('J2', "9");
        $objPHPExcel->getActiveSheet()->setCellValue('K1', "JS Dokter Lainnya");
        $objPHPExcel->getActiveSheet()->setCellValue('K2', "10");
        $objPHPExcel->getActiveSheet()->setCellValue('L1', "JS Dokter Anestesi");
        $objPHPExcel->getActiveSheet()->setCellValue('L2', "11");
        $objPHPExcel->getActiveSheet()->setCellValue('M1', "JS Penata Anestesi");
        $objPHPExcel->getActiveSheet()->setCellValue('M2', "12");
        $objPHPExcel->getActiveSheet()->setCellValue('N1', "JS Paramedis");
        $objPHPExcel->getActiveSheet()->setCellValue('N2', "13");
        $objPHPExcel->getActiveSheet()->setCellValue('O1', "JS Lainnya");
        $objPHPExcel->getActiveSheet()->setCellValue('O2', "14");
        $objPHPExcel->getActiveSheet()->setCellValue('P1', "JS ADM CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('P2', "15");
        $objPHPExcel->getActiveSheet()->setCellValue('Q1', "JS Sarana CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('Q2', "16");
        $objPHPExcel->getActiveSheet()->setCellValue('R1', "JS BHP CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('R2', "17");
        $objPHPExcel->getActiveSheet()->setCellValue('S1', "JS Dokter Operator CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('S2', "18");
        $objPHPExcel->getActiveSheet()->setCellValue('T1', "JS Dokter Lainnya CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('T2', "19");
        $objPHPExcel->getActiveSheet()->setCellValue('U1', "JS Dokter Anestesi CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('U2', "20");
        $objPHPExcel->getActiveSheet()->setCellValue('V1', "JS Penata Anestesi CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('V2', "21");
        $objPHPExcel->getActiveSheet()->setCellValue('W1', "JS Paramedis CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('W2', "22");
        $objPHPExcel->getActiveSheet()->setCellValue('X1', "JS Lainnya CTO");
        $objPHPExcel->getActiveSheet()->setCellValue('X2', "23");


        $no = 1;
        $i = 0;
        $x = 3;

        for ($col = 'A'; $col != 'H'; $col++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
        }

        $tindakan_list = MedisTindakan::find()->where(['parent_id' => $tindakan])->asArray()->all();
        // var_dump($tindakan_list);
        // exit;

        // echo "<pre>";
        // print_r($tindakan_list);
        // die;

        foreach ($tindakan_list as $data) {

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $x, $sk);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $x, Helper::getSkTarif($sk));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $x, $kelas);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $x, Helper::getKelasRawat($kelas));
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $x, $data['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $x, $data['deskripsi']);

            $x++;
            $i++;
            $no++;
        }


        $no++;
        // var_dump($model);
        // exit;

        $writer = new Xlsx($objPHPExcel);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Tenaga Keperawatan' . date('Ymdhis') . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    function actionFormImport()
    {
        $model = new MedisTarifTindakan();
        $model->scenario = 'importFile';
        //$model->scenario = MedisTindakan::SCENARIO_IMPORT;

        if ($model->load(Yii::$app->request->post())) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->importFile != null) {
                $filename = 'IMPORT-TARIF-TINDAKAN';
                $path = \Yii::getAlias('@webroot/berkas/' . $filename . '.' . $model->importFile->extension);
                $uploaded = $model->importFile->saveAs($path);
                if ($uploaded) {
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

                    for ($row = 3; $row <= $highestRow; $row++) {
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
                        INSERT INTO " . MedisTarifTindakan::TableName() . " (tindakan_id, kelas_rawat_kode, sk_tarif_id, js_adm, js_sarana, js_bhp, js_dokter_operator, js_dokter_lainya, js_dokter_anastesi, js_penata_anastesi, js_paramedis, js_lainya, js_adm_cto, js_sarana_cto, js_bhp_cto, js_dokter_operator_cto, js_dokter_lainya_cto, js_dokter_anastesi_cto, js_penata_anastesi_cto, js_paramedis_cto, js_lainya_cto, created_by) 
                        VALUES (:tinid, :kera, :skid, :adm, :sarana, :bhp, :dokop, :dolai, :dokan, :penan, :paramed, :lain, :adm_cto, :sarana_cto, :bhp_cto, :dokop_cto, :dolai_cto, :dokan_cto, :penan_cto, :paramed_cto, :lain_cto, :creby)", [
                            ':tinid' => $rowData[0][4],
                            ':kera' => $rowData[0][2],
                            ':skid' => $rowData[0][0],
                            ':adm' => $rowData[0][6],
                            ':sarana' => $rowData[0][7],
                            ':bhp' => $rowData[0][8],
                            ':dokop' => $rowData[0][9],
                            ':dolai' => $rowData[0][10],
                            ':dokan' => $rowData[0][11],
                            ':penan' => $rowData[0][12],
                            ':paramed' => $rowData[0][13],
                            ':lain' => $rowData[0][14],
                            ':adm_cto' => $rowData[0][15],
                            ':sarana_cto' => $rowData[0][16],
                            ':bhp_cto' => $rowData[0][17],
                            ':dokop_cto' => $rowData[0][18],
                            ':dolai_cto' => $rowData[0][19],
                            ':dokan_cto' => $rowData[0][20],
                            ':penan_cto' => $rowData[0][21],
                            ':paramed_cto' => $rowData[0][22],
                            ':lain_cto' => $rowData[0][23],
                            ':creby' => 1
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
}
