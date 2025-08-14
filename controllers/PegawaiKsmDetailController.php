<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\KelompokKsm;
use yii\filters\VerbFilter;
use app\models\KategoriDokter;
use app\models\KelompokSubKsm;
use app\models\PegawaiKsmDetail;
use app\models\PegawaiKsmDetailSearch;

/**
 * PegawaiKsmDetailController implements the CRUD actions for PegawaiKsmDetail model.
 */
class PegawaiKsmDetailController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new PegawaiKsmDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $kelompokKsmList = KelompokKsm::getList();
        $kelompokSubKsmList = KelompokSubKsm::getList();
        $kategoriDokterList = KategoriDokter::getList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'kelompokKsmList' => $kelompokKsmList,
            'kategoriDokterList' => $kategoriDokterList,
            'kelompokSubKsmList' => $kelompokSubKsmList,
        ]);
    }

    public function actionGetSubKsm($ksm_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $subList = KelompokSubKsm::getListByKsm($ksm_id);
        return $subList;
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new PegawaiKsmDetail();

        if ($model->load(Yii::$app->request->post(), '')) {

            if (PegawaiKsmDetail::isPegawaiAktif($model->pegawai_id)) {
                return [
                    'success' => false,
                    'message' => 'Pegawai ini sudah terdaftar dan masih aktif. Silakan refresh halaman.'
                ];
            }

            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => 'Pegawai KSM berhasil ditambahkan.'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Gagal menyimpan data. Periksa kembali input Anda.',
            'errors' => $model->getErrors()
        ];
    }

    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $model = PegawaiKsmDetail::findOne($id);

        if (!$model) {
            return ['success' => false, 'message' => 'Data tidak ditemukan.'];
        }

        $model->pegawai_id = Yii::$app->request->post('pegawai_id');
        $model->kelompok_sub_ksm_id = Yii::$app->request->post('kelompok_sub_ksm_id');
        $model->kategori_dokter_id = Yii::$app->request->post('kategori_dokter_id');
        $model->aktif = Yii::$app->request->post('aktif');

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data berhasil diperbarui!'
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal memperbarui data.',
            'errors' => $model->getErrors()
        ];
    }

    public function actionDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $model = PegawaiKsmDetail::findOne($id);
        
        if (!$model) {
            return [
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ];
        }

        $model->is_deleted = 1;
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Yii::$app->user->identity->id ?? null;

        if ($model->save(false)) { 
            return [
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal menghapus data.'
        ];
    }








   
}
