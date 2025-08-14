<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\components\Auth;
use app\models\Aplikasi;
use app\models\KomputerRs;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\KomputerRsSearch;
use Mpdf\Tag\Pre;
use yii\web\NotFoundHttpException;

/**
 * AplikasiController implements the CRUD actions for Aplikasi model.
 */
class KomputerRsController extends Controller
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
                        'actions' => ['logout', 'index','create','update','view','delete', 'toggle'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Lists all Aplikasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KomputerRsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new KomputerRs();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $data = $request->post('KomputerRs');

        $kode_unit = Yii::$app->security->generateRandomString(6);

        $insertData = [];

        foreach ($data['nama_ruangan'] as $nama_ruangan) {
            $model = new KomputerRs();
            $model->load($request->post());
            $model->kode_unit = $kode_unit;
            $model->nama_ruangan = $nama_ruangan;

            if ($model->save()) {
                $insertData[] = $model;
            }
        }

        if (!empty($insertData)) {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Ditambah.',
                'data' => $insertData,
            ];
        } else {
            $errors = $model->getErrors();
            return [
                'status' => 400,
                'message' => 'Gagal menambah data.',
                'data'  => $errors
            ];
        }
    }


   
  
    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
       
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {

            $data = Yii::$app->request->post();

            $model->kode_unit = $data['kode_unit'];
            $model->ip_address = $data['ip_address'];
            $model->mac_address = $data['mac_address'];
            $model->nama_ruangan = $data['nama_ruangan'];
            $model->keterangan = $data['keterangan'];

            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Diubah.',
                    'data'  => $model
                ];
            }else{
                $errors = $model->getErrors();
                return [
                    'status' => 400,
                    'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                    'data'  => $errors
                ];
            }
            
        } 
    }

   
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->is_deleted = 1;
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Yii::$app->user->identity->id;

        if ($model->save()) {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{               
            $errors = $model->getErrors();      
            return [
                'status' => 400,
                'message' => 'Terjadi kesalahan saat Menghapus Data.',
                'data'  => $errors
            ];

        }
    }

   
    protected function findModel($id)
    {
        if (($model = KomputerRs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionToggle($id)
    {
        $model = KomputerRs::findOne($id); // Ganti "YourModel" dengan nama model Anda

        if ($model) {
            // Toggle status notifikasi
            $model->is_notifikasi = $model->is_notifikasi ? 0 : 1;
            $model->save(false); // Simpan tanpa validasi

            return $this->asJson([
                'status' => 200,
                'message' => 'Status notifikasi berhasil diperbarui.',
                'is_notifikasi' => $model->is_notifikasi,
            ]);
        }

        return $this->asJson([
            'status' => 400,
            'message' => 'Data tidak ditemukan.',
        ]);
    }
}
