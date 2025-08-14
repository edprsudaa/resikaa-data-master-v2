<?php

namespace app\controllers;

use app\models\MedisIcd9cm;
use yii\filters\AccessControl;
use Yii;
use app\models\MedisIcd9cm2010;
use app\models\MedisIcd9cm2010Search;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * MedisIcd9cm2010Controller implements the CRUD actions for MedisIcd9cm2010 model.
 */
class MedisIcd9cm2010Controller extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

   
    public function actionIndex()
    {
        $searchModel = new MedisIcd9cm2010Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new MedisIcd9cm2010();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new MedisIcd9cm2010();

        // $cekKode = MedisIcd9cm2010::find()->where(['kode'=> Yii::$app->request->post('kode')])->andWhere(['is_deleted'=>0])->one();

        // echo '<pre>';
        // print_r($cekKode);die;

        // if (!empty($cekKode)) {
        //     return [
        //         'status'    => 1,
        //         'message' => 'Kode Telah Terdaftar.',
        //         'data'  => $cekKode
        //     ];
        // }

        if (Yii::$app->request->post()) {
            $model->aktif = 1;
            $model->is_deleted = 0;
            $model->kode = Yii::$app->request->post('kode');
            $model->deskripsi = Yii::$app->request->post('deskripsi');
            $model->keterangan = Yii::$app->request->post('deskripsi');
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;

            if ($model->save()) {
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
       
    }


    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->kode = Yii::$app->request->post('kode');
        $model->deskripsi = Yii::$app->request->post('deskripsi');
        $model->keterangan = Yii::$app->request->post('deskripsi');
        $model->aktif = Yii::$app->request->post('status');
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;


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
        $model->is_deleted = '1';
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

    protected function findModel($id)
    {
        if (($model = MedisIcd9cm2010::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function actionFormImport()
    {
        $model = new MedisIcd9cm2010();
        $model->scenario = 'importFile';

        if ($model->load(Yii::$app->request->post())) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->importFile != null) {
                $filename = 'IMPORT-ICD-9-2010';
                $path = \Yii::getAlias('@webroot/berkas/' . $filename . '.' . $model->importFile->extension);
                $uploaded = $model->importFile->saveAs($path);
                if ($uploaded) {
                    // Mengidentifikasi Filename
                    $readerType = IOFactory::identify($path);
                    // Membaca Filename berdasarkan Type File
                    $objReader = IOFactory::createReader($readerType);
                    // Meload Filename
                    $objPHPExcel = $objReader->load($path);
                    $data = [];
                    // Membaca Sheet 1 Array 1
                    $sheet = $objPHPExcel->getSheet(0);
                    // Membaca Banyak Baris Atau baris Terakhir Sheet 2 Array 1
                    $highestRow = $sheet->getHighestRow();
                    // Membaca Kolom Terakhir atau Tertinggi Sheet 2 Array 1
                    $highestColumn = $sheet->getHighestColumn();
                    // for ($i = 0; $i < 25; $i++) {
                    //     // $sheet = $objPHPExcel->getSheet(0);
                    // }
                    for ($row = 2; $row <= $highestRow; $row++) {
                        // Membaca Array dari Excel dengan batasan Tertentu Exp : A - Kolom Tertinggi
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        // $model->parent_id = $id;
                        // $model->deskripsi = $rowData[0][0];
                        // $model->aktif = $rowData[0][1];
                        // $model->kode_jenis = $rowData[0][2];
                        // $model->created_by = 1;
                        // $model = new MedisIcd10cm2010();
                        // $model->parent_id = '';
                        // $model->kode = '';
                        // $model->deskripsi = '';
                        // $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                        // $model->aktif = 1;
                        // $model->is_deleted = 0;
                        // $data[] = $rowData;

                        $model = new MedisIcd9cm2010();
                        $kode = strval($rowData[0][0]);
                        $deskripsi = strval($rowData[0][1]);
                        // $name = strval($rowData[0][2]);
                        $model->kode = $kode;
                        $model->deskripsi = $deskripsi;
                        $model->keterangan = $deskripsi;
                        $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                        $model->aktif = 1;
                        $model->is_deleted = 0;
                        // if (strcmp($subCategory, "") === 0) {
                        // } else {
                        //     $parent = MedisIcd9cm::find()->where(['kode' => $category])->limit(1)->one();
                        //     if ($parent) {
                        //         $model->parent_id = $parent->id;
                        //         $model->kode = $category . '.' . $subCategory;
                        //         $model->deskripsi = $name;
                        //         $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                        //         $model->aktif = 1;
                        //         $model->is_deleted = 0;
                        //     } else {
                        //         $model->kode = $category . '.' . $subCategory;
                        //         $model->deskripsi = $name;
                        //         $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                        //         $model->aktif = 1;
                        //         $model->is_deleted = 0;
                        //     }
                        // }

                        // $data[] = $model;
                        // echo $rowData[0][0] . '<br>' . !empty($rowData[0][1]) . '<br>' . $rowData[0][2];
                        // echo '<pre>';
                        // print_r($model);
                        // echo '</pre>';
                        // exit;

                        $model->save();
                    }
                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                    // exit;
                }
            }
            Yii::$app->session->setFlash('success', 'Data Berhasil');
            return $this->redirect(['index']);
        }

        // if ($model->load(Yii::$app->request->post())) {
        //     $gen = $_POST['MedisIcd10cm2010']['generasi'];

        //     $model->importFile = UploadedFile::getInstance($model, 'importFile');
        //     if ($model->importFile != null) {
        //         $filename = 'IMPORT-ICD10CM';
        //         $path = \Yii::getAlias('@webroot/berkas/' . $filename . '.' . $model->importFile->extension);
        //         $uploaded = $model->importFile->saveAs($path);
        //         if ($uploaded) {
        //             $data = file_get_contents('berkas/IMPORT-ICD10CM.json');
        //             $result = json_decode($data, true);

        //             if ($gen == 1) {
        //                 $res_full = $result["chapter"]["sectionIndex"]['sectionRef'];
        //                 foreach ($res_full as $sref) {
        //                     // Insert Data
        //                     Yii::$app->db->createCommand("
        //                         INSERT INTO " . MedisIcd10cm2010::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
        //                         VALUES (:parid, :kd, :desk, :akt, :creby)", [
        //                         ':parid' => $id,
        //                         ':kd' => $sref['_id'],
        //                         ':desk' => $sref['__text'],
        //                         ':akt' => 1,
        //                         ':creby' => 1
        //                     ])->execute();
        //                 }
        //             } else if ($gen == 2) {
        //                 $res_full = $result["chapter"]["section"];

        //                 foreach ($res_full as $v) {
        //                     if ($v['_id'] == $kode) {
        //                         $data_diag = $v['diag'];
        //                         foreach ($data_diag as $diag) {
        //                             // Insert Data
        //                             Yii::$app->db->createCommand("
        //                             INSERT INTO " . MedisIcd10cm2010::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
        //                             VALUES (:parid, :kd, :desk, :akt, :creby)", [
        //                                 ':parid' => $id,
        //                                 ':kd' => $diag['name'],
        //                                 ':desk' => $diag['desc'],
        //                                 ':akt' => 1,
        //                                 ':creby' => 1
        //                             ])->execute();
        //                         }
        //                     }
        //                 }
        //             } else if ($gen == 3) {
        //                 $res_full = $result["chapter"]["section"];

        //                 foreach ($res_full as $v) {
        //                     if (!empty($v['diag'])) {
        //                         $data_diag = $v['diag'];
        //                         foreach ($data_diag as $diag) {
        //                             // var_dump(isset($data_diag2[0]));exit;
        //                             if (@$diag['name'] == $kode) {
        //                                 $data_diag2 = $diag['diag'];
        //                                 if (isset($data_diag2[0])) {
        //                                     foreach ($data_diag2 as $diag2) {
        //                                         // Insert Data
        //                                         Yii::$app->db->createCommand("
        //                                     INSERT INTO " . MedisIcd10cm2010::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
        //                                     VALUES (:parid, :kd, :desk, :akt, :creby)", [
        //                                             ':parid' => $id,
        //                                             ':kd' => $diag2['name'],
        //                                             ':desk' => $diag2['desc'],
        //                                             ':akt' => 1,
        //                                             ':creby' => 1
        //                                         ])->execute();
        //                                     }
        //                                 } else {
        //                                     Yii::$app->db->createCommand("
        //                                     INSERT INTO " . MedisIcd10cm2010::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
        //                                     VALUES (:parid, :kd, :desk, :akt, :creby)", [
        //                                         ':parid' => $id,
        //                                         ':kd' => $data_diag2['name'],
        //                                         ':desk' => $data_diag2['desc'],
        //                                         ':akt' => 1,
        //                                         ':creby' => 1
        //                                     ])->execute();
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             } else if ($gen == 4) {
        //                 $res_full = $result["chapter"]["section"];

        //                 foreach ($res_full as $v) {
        //                     $data_diag = $v['diag'];
        //                     foreach ($data_diag as $diag) {
        //                         if (!empty($diag['diag'])) {
        //                             $data_diag2 = $diag['diag'];
        //                             foreach ($data_diag2 as $diag2) {
        //                                 if ($diag2['name'] == $kode) {
        //                                     $data_diag3 = $diag2['diag'];
        //                                     foreach ($data_diag3 as $diag3) {
        //                                         // Insert Data
        //                                         Yii::$app->db->createCommand("
        //                                     INSERT INTO " . MedisIcd10cm2010::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
        //                                     VALUES (:parid, :kd, :desk, :akt, :creby)", [
        //                                             ':parid' => $id,
        //                                             ':kd' => $diag3['name'],
        //                                             ':desk' => $diag3['desc'],
        //                                             ':akt' => 1,
        //                                             ':creby' => 1
        //                                         ])->execute();
        //                                     }
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     return $this->redirect(['index']);
        // }

        return $this->render('form-import', [
            'model' => $model,
        ]);
    }
}
