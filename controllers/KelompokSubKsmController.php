<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\KelompokKsm;
use app\models\KelompokSubKsm;
use app\models\KelompokSubKsmSearch;

class KelompokSubKsmController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new KelompokSubKsmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $listKelompokKsm = KelompokKsm::getList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'kelompokKsm' => $listKelompokKsm,
        ]);
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new KelompokSubKsm();

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true,
                'message' => 'Sub KSM berhasil disimpan.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal menyimpan data. Periksa kembali input Anda.'
        ];
    }

    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $model = KelompokSubKsm::findOne($id);

        if (!$model) {
            return ['success' => false, 'message' => 'Data tidak ditemukan.'];
        }

        $model->nama = Yii::$app->request->post('nama');
        $model->aktif = Yii::$app->request->post('aktif');
        $model->target_poin = Yii::$app->request->post('targetPoin');

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data berhasil diperbarui!'
            ];
        }

        return [
            'success' => false,
            'message' => 'Gagal memperbarui data.'
        ];
    }

    public function actionDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $model = KelompokSubKsm::findOne($id);
        
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
