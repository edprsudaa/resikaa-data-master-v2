<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;
use app\models\MedisIcd10cm;
use app\models\MedisIcd10cmSearch;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MedisIcd10cmController implements the CRUD actions for MedisIcd10cm model.
 */
class MedisIcd10cmController extends Controller
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
     * Lists all MedisIcd10cm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisIcd10cmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $mod_icd10cm = new MedisIcd10cm();
        $icd10cm = $mod_icd10cm->getIcd10Cm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'icd10cm' => $icd10cm,
        ]);
    }

    /**
     * Displays a single MedisIcd10cm model.
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
     * Creates a new MedisIcd10cm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisIcd10cm();
        $mod_icd10cm = new MedisIcd10cm();
        $icd10cm = $mod_icd10cm->getIcd10Cm();

        $q = Yii::$app->request;
        if ($model->load($q->post())) {
            $model->created_by = 1;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->aktif = 1;
        }

        return $this->render('create', [
            'model' => $model,
            'icd10cm' => $icd10cm,
        ]);
    }

    /**
     * Updates an existing MedisIcd10cm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mod_icd10cm = new MedisIcd10cm();
        $icd10cm = $mod_icd10cm->getIcd10Cm();

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
            'icd10cm' => $icd10cm,
        ]);
    }

    /**
     * Deletes an existing MedisIcd10cm model.
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
        // $model->updated_by = Yii::$app->user->identity->kodeAkun;
        if ($model->save()) {
            return $this->redirect(['index']);
        } 
    }

    /**
     * Finds the MedisIcd10cm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisIcd10cm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisIcd10cm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function actionFormImport($id, $kode)
    {
        $model = new MedisIcd10cm();
        $model->scenario = 'importFile';

        if ($model->load(Yii::$app->request->post())) {
            $gen=$_POST['MedisIcd10cm']['generasi'];

            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->importFile != null) {
                $filename = 'IMPORT-ICD10CM';
                $path = \Yii::getAlias('@webroot/berkas/' . $filename . '.' . $model->importFile->extension);
                $uploaded = $model->importFile->saveAs($path);
                if ($uploaded) {
                    $data = file_get_contents('berkas/IMPORT-ICD10CM.json');
                    $result = json_decode($data, true);

                    if($gen==1){
                            $res_full = $result["chapter"]["sectionIndex"]['sectionRef'];
                            foreach ($res_full as $sref) {
                                // Insert Data
                                Yii::$app->db->createCommand("
                                INSERT INTO " . MedisIcd10cm::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
                                VALUES (:parid, :kd, :desk, :akt, :creby)", [
                                    ':parid' => $id,
                                    ':kd' => $sref['_id'],
                                    ':desk' => $sref['__text'],
                                    ':akt' => 1,
                                    ':creby' => 1
                                ])->execute();
                            }
                    } else if($gen==2){
                        $res_full = $result["chapter"]["section"];
                        
                        foreach ($res_full as $v) {
                            if($v['_id']==$kode){
                                $data_diag = $v['diag'];
                                foreach ($data_diag as $diag) {
                                    // Insert Data
                                    Yii::$app->db->createCommand("
                                    INSERT INTO " . MedisIcd10cm::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
                                    VALUES (:parid, :kd, :desk, :akt, :creby)", [
                                        ':parid' => $id,
                                        ':kd' => $diag['name'],
                                        ':desk' => $diag['desc'],
                                        ':akt' => 1,
                                        ':creby' => 1
                                    ])->execute();
                                }
                            }
                        }
                    } else if($gen==3){
                        $res_full = $result["chapter"]["section"];
                        
                        foreach ($res_full as $v) {
                            if(!empty($v['diag'])){	
                                $data_diag = $v['diag'];
                                foreach ($data_diag as $diag) {
                                    // var_dump(isset($data_diag2[0]));exit;
                                    if(@$diag['name']==$kode){
                                    $data_diag2 = $diag['diag'];
                                    if(isset($data_diag2[0])){
                                        foreach ($data_diag2 as $diag2) {
                                        // Insert Data
                                            Yii::$app->db->createCommand("
                                            INSERT INTO " . MedisIcd10cm::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
                                            VALUES (:parid, :kd, :desk, :akt, :creby)", [
                                                ':parid' => $id,
                                                ':kd' => $diag2['name'],
                                                ':desk' => $diag2['desc'],
                                                ':akt' => 1,
                                                ':creby' => 1
                                            ])->execute();
                                        }
                                    }else{
                                        Yii::$app->db->createCommand("
                                            INSERT INTO " . MedisIcd10cm::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
                                            VALUES (:parid, :kd, :desk, :akt, :creby)", [
                                                ':parid' => $id,
                                                ':kd' => $data_diag2['name'],
                                                ':desk' => $data_diag2['desc'],
                                                ':akt' => 1,
                                                ':creby' => 1
                                            ])->execute();
                                    }
                                    }
                                }
                            }
                        }
                    } else if($gen==4){
                        $res_full = $result["chapter"]["section"];
                        
                        foreach ($res_full as $v) {
                                $data_diag = $v['diag'];
                                foreach ($data_diag as $diag) {
                                    if(!empty($diag['diag'])){
                                    $data_diag2 = $diag['diag'];
                                    foreach ($data_diag2 as $diag2) {
                                        if($diag2['name']==$kode){
                                        $data_diag3 = $diag2['diag'];
				                        foreach ($data_diag3 as $diag3){
                                        // Insert Data
                                            Yii::$app->db->createCommand("
                                            INSERT INTO " . MedisIcd10cm::TableName() . " (parent_id, kode, deskripsi, aktif, created_by) 
                                            VALUES (:parid, :kd, :desk, :akt, :creby)", [
                                                ':parid' => $id,
                                                ':kd' => $diag3['name'],
                                                ':desk' => $diag3['desc'],
                                                ':akt' => 1,
                                                ':creby' => 1
                                            ])->execute();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

            return $this->redirect(['index']);
        }

        return $this->render('form-import', [
            'model' => $model,
        ]);
    }

    function actionDownload()
    {
        $root = Yii::getAlias('@webroot') . '/berkas/IMPORT-TINDAKAN.xlsx';
        if (file_exists($root)) {
            return Yii::$app->response->sendFile($root);
        } else {
            throw new NotFoundHttpException("{$root} is not found!");
        }
    }
}
