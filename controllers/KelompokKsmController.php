<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\KelompokKsm;
use yii\filters\VerbFilter;
use app\models\KelompokKsmSearch;
use yii\web\NotFoundHttpException;

/**
 * KelompokKsmController implements the CRUD actions for KelompokKsm model.
 */
class KelompokKsmController extends Controller
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
        $searchModel = new KelompokKsmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new KelompokKsm();

        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true,
                'message' => 'Kelompok KSM berhasil disimpan.'
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
        $model = KelompokKsm::findOne($id);

        if (!$model) {
            return ['success' => false, 'message' => 'Data tidak ditemukan.'];
        }

        $model->nama = Yii::$app->request->post('nama');
        $model->aktif = Yii::$app->request->post('aktif');

        if ($model->save()) {
            return ['success' => true, 'message' => 'Data berhasil diperbarui.'];
        }

        return ['success' => false, 'message' => 'Gagal memperbarui data.'];
    }

    public function actionDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');
        $model = KelompokKsm::findOne($id);
        
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
