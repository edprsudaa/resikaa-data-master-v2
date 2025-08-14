<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TbPegawai;
use app\models\MappingDpjp;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\MappingPoliBpjs;
use app\models\MappingDpjpSearch;
use yii\web\NotFoundHttpException;

/**
 * MappingDpjpController implements the CRUD actions for MappingDpjp model.
 */
class MappingDpjpController extends Controller
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
     * Lists all MappingDpjp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MappingDpjpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $subPoliOptions = ArrayHelper::map(
            MappingPoliBpjs::find()
            ->select(['bpjs_sub_kode', 'bpjs_sub_nama'])
            ->distinct()
            ->orderBy(['bpjs_sub_nama' => SORT_ASC])
            ->asArray()
            ->all(),
            'bpjs_sub_kode',
            function ($item) {
                return '(' . $item['bpjs_sub_kode'] . ') ' . $item['bpjs_sub_nama'];
            }
        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subPoliOptions' => $subPoliOptions,
        ]);
    }

    /**
     * Displays a single MappingDpjp model.
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
     * Creates a new MappingDpjp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MappingDpjp();

        $pegawai = TbPegawai::find()
            ->select(['pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap, ' ', gelar_sarjana_belakang) AS full_name")])
            ->where(['status_aktif_pegawai' => 1])
            ->andWhere(['or', 
                ['like', 'LOWER(gelar_sarjana_depan)', 'dr'],
                ['like', 'LOWER(gelar_sarjana_depan)', 'drg']
            ])
            ->orderBy(['nama_lengkap' => SORT_ASC])
            ->asArray()
            ->all();    

        $mappingPoliBpjs = MappingPoliBpjs::find()
            ->where(['not', ['simrs_kode' => null]])
            ->all();

        if ($model->load(Yii::$app->request->post())) {     
            
            $simrs_dpjp_kode = TbPegawai::findOne(['pegawai_id' => $model->simrs_dpjp_kode]);
            $model->simrs_dpjp_kode_old = $simrs_dpjp_kode->kode_dokter_maping_simrs != null ? $simrs_dpjp_kode->kode_dokter_maping_simrs : null;            
            $model->save();
                
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'pegawai' => $pegawai,
            'mappingPoliBpjs' => $mappingPoliBpjs
        ]);
    }

    /**
     * Updates an existing MappingDpjp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $pegawai = TbPegawai::find()
            ->select(['pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap, ' ', gelar_sarjana_belakang) AS full_name")])
            ->where(['status_aktif_pegawai' => 1])
            ->andWhere(['or', 
                ['like', 'LOWER(gelar_sarjana_depan)', 'dr'],
                ['like', 'LOWER(gelar_sarjana_depan)', 'drg']
            ])
            ->orderBy(['nama_lengkap' => SORT_ASC])
            ->asArray()
            ->all();    

        $mappingPoliBpjs = MappingPoliBpjs::find()
            ->where(['not', ['simrs_kode' => null]])
            ->all();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'pegawai' => $pegawai,
            'mappingPoliBpjs' => $mappingPoliBpjs
        ]);
    }

    /**
     * Deletes an existing MappingDpjp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MappingDpjp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MappingDpjp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MappingDpjp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionSubPoliList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $params = $_POST['depdrop_params'] ?? [];

            if ($parents != null) {
                $poliKode = $parents[0];
                $selected = $params[0] ?? '';

                $data = MappingPoliBpjs::find()
                    ->where(['bpjs_kode' => $poliKode])
                    ->with('unit') // pastikan relasi "unit" tersedia
                    ->orderBy(['bpjs_sub_nama' => SORT_ASC])
                    ->all();

                $output = [];
                foreach ($data as $item) {
                    $unitNama = $item->unit->nama ?? '-'; // atau ->nama_unit, tergantung field-nya
                    $output[] = [
                        'id' => $item->bpjs_sub_kode,
                        'name' => $item->bpjs_sub_nama . ' (' . $unitNama .')',
                    ];
                }

                return ['output' => $output, 'selected' => $selected];
            }
        }

        return ['output' => [], 'selected' => ''];
    }





}
