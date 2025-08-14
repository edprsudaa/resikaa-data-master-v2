<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
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
        $unit_penempatan    = PegawaiUnitPenempatan::find()->orderBy(['nama' => SORT_ASC])->all();
        $kelasRawat         = PendaftaranKelasRawat::find()->orderBy(['kode' => SORT_ASC])->all();

        $kelasRawat[] = [
            'nama' => 'SEMUA KELAS',
            'kode'  => 'all'
        ];

        $dataTindakan       = MedisTarifTindakanUnit::getTindakannya();

        $tindakanUnit = new MedisTarifTindakanUnit();
        $data_tindakan_unit_parent = $tindakanUnit->getTindakanMedisParent();
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
            'data_tindakan_unit_parent' => $data_tindakan_unit_parent
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

        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = 1;
            if ($model->save()) {
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

        $model->is_deleted = '1';
        $model->updated_at = $date;
        $model->updated_by = Yii::$app->user->identity->id;
        if ($model->save()) {
            // alert('oke');
            return $this->redirect(['index']);
        }
    }

    public function actionHapus($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->is_deleted = 1;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->save()) {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Dihapus.'
            ];
        } else {
            $errors = $model->getErrors();
            return [
                'status' => 400,
                'message' => 'Terjadi kesalahan saat Menghapus Data.',
                'data'  => $errors
            ];
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
        $kelas = PendaftaranKelasRawat::find()->orderBy(['kode' => SORT_ASC])->all();

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
            'kelas' => $kelas
        ]);
    }

    public function actionDataTindakan($q = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = \Yii::$app->db->createCommand("
                SELECT a.id, a.parent_id, a.deskripsi FROM " . MedisTindakan::tableName() . " as a where a.id in 
                (select b.tindakan_id FROM " . MedisTarifTindakan::tableName() . " as b group by b.tindakan_id) 
                WHERE a.deskripsi LIKE %" . $q . "%
                order by a.id asc")->queryAll();
            $out['results'] = array_values($data);
            return $out;
        }
    }

    public function actionInputForm()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tindakan = Yii::$app->request->post('tindakannya');
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
        $tindakan = Yii::$app->request->post('tindakannya');
        $unit = Yii::$app->request->post('unitId');

        // alert($unit);

        // print_r('unit',$unit);die;
        $model = new MedisTarifTindakanUnit();
        $data = $model->getTarifTindakanByUnit($tindakan, $unit);

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
        $tindakan = Yii::$app->request->post('tindakannya');
        $unit = Yii::$app->request->post('unitId');
        $kelas = Yii::$app->request->post('kelasId');

        // print_r('kelas',$kelas);
        $model = new MedisTarifTindakanUnit();
        $data = $model->getTarifTindakanByUnitKelas($tindakan, $unit, $kelas);

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

        $parentId = Yii::$app->request->post('parent_id');
        $tarif_tindakan_id = Yii::$app->request->post('tindakan_id');
        $kode_kelas = Yii::$app->request->post('kelas');
        $unitId = Yii::$app->request->post('unit_id');

        $tindakanList = [];

        // 🔁 Jika tindakan_id == 'all', ambil semua tindakan berdasarkan parent_id
        if ($tarif_tindakan_id === 'all') {
            if (empty($parentId)) {
                return [
                    'status' => 400,
                    'message' => 'Parent ID tidak ditemukan.',
                    'data' => null
                ];
            }

            $tindakanList = MedisTindakan::find()
                ->where(['parent_id' => $parentId, 'aktif' => 1])
                ->all();

            if (empty($tindakanList)) {
                return [
                    'status' => 400,
                    'message' => 'Tidak ada tindakan anak untuk parent ini.',
                    'data' => null
                ];
            }
        } else {
            // jika hanya 1 tindakan biasa
            $tindakan = MedisTindakan::findOne($tarif_tindakan_id);
            if ($tindakan) {
                $tindakanList[] = $tindakan;
            } else {
                return [
                    'status' => 400,
                    'message' => 'Tindakan tidak ditemukan.',
                    'data' => null
                ];
            }
        }

        $kelasRawat = [];
        if ($kode_kelas === 'all') {
            $kelasRawat = PendaftaranKelasRawat::find()->where(['aktif' => 1])->orderBy(['kode' => SORT_ASC])->all();
        } else {
            $kelasItem = PendaftaranKelasRawat::findOne(['kode' => $kode_kelas]);
            if ($kelasItem) {
                $kelasRawat[] = $kelasItem;
            } else {
                return [
                    'status' => 400,
                    'message' => 'Kelas tidak ditemukan.',
                    'data' => null
                ];
            }
        }

        $jumlahBerhasil = 0;
        $logGagal = [];

        foreach ($tindakanList as $tindakan) {
            foreach ($kelasRawat as $kelasItem) {
                $getTarifTindakanId = MedisTarifTindakan::find()
                    ->where([
                        'tindakan_id' => $tindakan->id,
                        'kelas_rawat_kode' => $kelasItem->kode
                    ])
                    ->one();

                if (!empty($getTarifTindakanId)) {
                    $existing = MedisTarifTindakanUnit::find()
                        ->where([
                            'tarif_tindakan_id' => $getTarifTindakanId->id,
                            'unit_id' => $unitId,
                            'is_deleted' => 0
                        ])
                        ->exists();

                    if ($existing) {
                        continue; // Skip jika sudah ada
                    }
                    $getLastId = MedisTarifTindakanUnit::find()->select('MAX(id)')->scalar();

                    $model = new MedisTarifTindakanUnit();
                    $model->id = $getLastId + 1;
                    $model->tarif_tindakan_id = $getTarifTindakanId->id;
                    $model->unit_id = $unitId;
                    $model->aktif = 1;
                    $model->is_deleted = 0;
                    $model->created_by = Yii::$app->user->identity->id;

                    if ($model->save()) {
                        $jumlahBerhasil++;
                    } else {
                        $logGagal[] = [
                            'tindakan' => $tindakan->deskripsi ?? $tindakan->id,
                            'kelas' => $kelasItem->kode,
                            'error' => $model->getErrors(),
                        ];
                    }
                } else {
                    $logGagal[] = [
                        'tindakan' => $tindakan->deskripsi ?? $tindakan->id,
                        'kelas' => $kelasItem->kode,
                        'error' => 'Tarif tindakan tidak ditemukan.'
                    ];
                }
            }
        }

        return [
            'status' => $jumlahBerhasil > 0 ? 200 : 400,
            'message' => $jumlahBerhasil > 0 ? 'Data berhasil ditambah sebagian/semua.' : 'Gagal menambahkan data.',
            'data' => [
                'berhasil' => $jumlahBerhasil,
                'gagal' => $logGagal,
            ]
        ];
    }


    public function actionDeleteData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        $model = $this->findModel($id);

        $model->is_deleted = 1;

        $model->save();
    }

    public function actionTindakanUnit($q = null)
    {
        $idParent = Yii::$app->request->get('id_parent');
        $tarifTindakanUnit = MedisTarifTindakanUnit::getTindakanMedisChild($idParent);

        $hasil = [
            'results' => $tarifTindakanUnit,
        ];

        return Json::encode($hasil);
    }
}
