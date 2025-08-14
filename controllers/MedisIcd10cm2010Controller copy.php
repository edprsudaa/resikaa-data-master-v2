<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;
use app\models\MedisIcd10cm2010;
use app\models\MedisIcd10cm2010Search;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MedisIcd10cm2010Controller implements the CRUD actions for MedisIcd10cm2010 model.
 */
class MedisIcd10cm2010Controller extends Controller
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

    /**
     * Lists all MedisIcd10cm2010 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisIcd10cm2010Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $icd10cm = MedisIcd10cm2010::getIcd10Cm2010();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'icd10cm' => $icd10cm,
        ]);
    }

    /**
     * Displays a single MedisIcd10cm2010 model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $referensi = MedisIcd10cm2010::getOneIcd10cm2010($model->parent_id);
        if (empty($referensi)) {
            $referensi = '-';
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $model,
                'referensi' => $referensi,
            ]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'referensi' => $referensi,
            ]);
        }
    }

    /**
     * Creates a new MedisIcd10cm2010 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisIcd10cm2010();
        $icd10cm = MedisIcd10cm2010::getIcd10Cm2010();

        if ($this->request->isPost) {
            // Do nothing
        } else {
            $model->loadDefaultValues();
            $model->aktif = 1;
        }
        if ($this->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'icd10cm' => $icd10cm,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'icd10cm' => $icd10cm,
            ]);
        }
    }

    public function actionSaveData()
    {
        try {
            $req = Yii::$app->request;

            if ($req->isAjax) {
                $id = $req->post('id');
                $is_update = false;
                if ($id != null) {
                    $model = MedisIcd10cm2010::find()->where(['id' => $id])->limit(1)->one();
                    $is_update = true;
                } else {
                    $model = new MedisIcd10cm2010();
                }
                if ($model->load($req->post())) {
                    $user = Yii::$app->user->getIdentity()->idProfil;
                    if ($is_update) {
                        $model->updated_by = $user;
                        $model->updated_at = date('Y-m-d H:i:s');
                    } else {
                        $model->created_by = $user;
                        $model->aktif = 1;
                    }
                    $model->is_deleted = 0;
                    if ($model->save()) {
                        if ($is_update) {
                            Yii::$app->session->setFlash('success', 'Data ICD-10 berhasil diupdate');
                        } else {
                            Yii::$app->session->setFlash('success', 'Data ICD-10 berhasil ditambahkan');
                        }
                        return $this->asJson(['status' => true]);
                    } else {
                        return $this->asJson(['status' => false, 'message' => 'Data tidak berhasil disimpan']);
                    }
                } else {
                    return $this->asJson(['status' => false, 'message' => 'Data tidak berhasil diakses']);
                }
            }
        } catch (\Throwable $th) {
            return $this->asJson(['status' => false, 'message' => $th]);
        }
    }

    /**
     * Updates an existing MedisIcd10cm2010 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $icd10cm = MedisIcd10cm2010::getIcd10Cm2010();

        if ($this->request->isPost) {
            // Do nothing
        } else {
            $model->loadDefaultValues();
            $model->aktif = 1;
        }
        if ($this->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
                'icd10cm' => $icd10cm,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'icd10cm' => $icd10cm,
            ]);
        }
    }

    /**
     * Deletes an existing MedisIcd10cm2010 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $date = date('Y-m-d H:i:s');
        $model = $this->findModel($id);
        $user = Yii::$app->user->getIdentity()->idProfil;

        $model->is_deleted = '1';
        $model->updated_at = $date;
        $model->updated_by = $user;
        // $model->updated_by = Yii::$app->user->identity->kodeAkun;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Data ICD-10 berhasil dihapus');
            // return $this->redirect(['/medis-icd10cm2010']);
        }
    }

    /**
     * Finds the MedisIcd10cm2010 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisIcd10cm2010 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisIcd10cm2010::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function actionFormImport()
    {
        $model = new MedisIcd10cm2010();
        $model->scenario = 'importFile';

        if ($model->load(Yii::$app->request->post())) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->importFile != null) {
                $filename = 'IMPORT-ICD-10-2010';
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
                    for ($i = 0; $i < 25; $i++) {
                        // Membaca Sheet 1 Array 1
                        $sheet = $objPHPExcel->getSheet($i);
                        // $sheet = $objPHPExcel->getSheet(0);
                        // Membaca Banyak Baris Atau baris Terakhir Sheet 2 Array 1
                        $highestRow = $sheet->getHighestRow();
                        // Membaca Kolom Terakhir atau Tertinggi Sheet 2 Array 1
                        $highestColumn = $sheet->getHighestColumn();

                        // echo '<pre>';
                        // print_r($highestColumn);
                        // echo '</pre>';
                        // exit;

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

                            $model = new MedisIcd10cm2010();
                            $category = strval($rowData[0][0]);
                            $subCategory = strval($rowData[0][1]);
                            $name = strval($rowData[0][2]);
                            if (strcmp($subCategory, "") === 0) {
                                $model->kode = $category;
                                $model->deskripsi = $name;
                                $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                                $model->aktif = 1;
                                $model->is_deleted = 0;
                            } else {
                                $parent = MedisIcd10cm2010::find()->where(['kode' => $category])->limit(1)->one();
                                if ($parent) {
                                    $model->parent_id = $parent->id;
                                    $model->kode = $category . '.' . $subCategory;
                                    $model->deskripsi = $name;
                                    $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                                    $model->aktif = 1;
                                    $model->is_deleted = 0;
                                } else {
                                    $model->kode = $category . '.' . $subCategory;
                                    $model->deskripsi = $name;
                                    $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                                    $model->aktif = 1;
                                    $model->is_deleted = 0;
                                }
                            }

                            $data[] = $model;
                            // echo $rowData[0][0] . '<br>' . !empty($rowData[0][1]) . '<br>' . $rowData[0][2];
                            // echo '<pre>';
                            // print_r($model);
                            // echo '</pre>';
                            // exit;

                            $model->save();
                        }
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

    function actionFormImportNew()
    {
        $model = new MedisIcd10cm2010();
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

                        $model = new MedisIcd10cm2010();
                        $kode = strval($rowData[0][0]);
                        $deskripsi = strval($rowData[0][1]);
                        // $name = strval($rowData[0][2]);
                        $model->kode = $kode;
                        $model->deskripsi = $deskripsi;
                        $model->keterangan = $deskripsi;
                        $model->created_by = Yii::$app->user->getIdentity()->idProfil;
                        $model->aktif = 1;
                        $model->is_deleted = 0;
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
        return $this->render('form-import', [
            'model' => $model,
        ]);
    }

    // function actionDownload()
    // {
    //     $root = Yii::getAlias('@webroot') . '/berkas/IMPORT-TINDAKAN.xlsx';
    //     if (file_exists($root)) {
    //         return Yii::$app->response->sendFile($root);
    //     } else {
    //         throw new NotFoundHttpException("{$root} is not found!");
    //     }
    // }
}
