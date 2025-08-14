<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\Controller;
use app\models\Kabupaten;
use app\models\Kecamatan;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\KecamatanSearch;
use yii\web\NotFoundHttpException;

/**
 * KecamatanController implements the CRUD actions for Kecamatan model.
 */
class KecamatanController extends Controller
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
     * Lists all Kecamatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KecamatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Kecamatan();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Kecamatan model.
     * @param string $id
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
     * Creates a new Kecamatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Kecamatan();

        if ($model->load(Yii::$app->request->post())) {

            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->aktif   = 1;

            //    echo '<pre>';
            //    print_r($model);die;

            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Ditambah.',
                    'data'  => $model
                ];
            } else {
                $errors = $model->getErrors();
                return [
                    'status' => 400,
                    'message' => 'Terjadi kesalahan saat Menambahkan Data.',
                    'data'  => $errors
                ];
            }
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->post()) {
            $model->kode_prov_kab_kecamatan = Yii::$app->request->post('kode_kecamatan');
            $model->nama = Yii::$app->request->post('nama_kecamatan');
            $model->kode_prov_kab = Yii::$app->request->post('kode_kabupaten');
            $model->kode_prov = Yii::$app->request->post('kode_provinsi');
            $model->aktif = Yii::$app->request->post('aktif');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;


            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Diubah.',
                    'data'  => $model
                ];
            } else {
                $errors = $model->getErrors();
                return [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat Mengubah Data.',
                    'data'  => $errors
                ];
            }
        }
    }

    /**
     * Deletes an existing Kecamatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionDelete($id)
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
                'message' => 'Terjadi kesalahan saat Menghapus Data Ini.',
                'data'  => $errors
            ];
        }
    }

    /**
     * Finds the Kecamatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kecamatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kecamatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetKecamatanByKabupaten()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $post = Yii::$app->request->post();

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $kabupaten_kode = $parents[0];

                $kecamatans = Kecamatan::getKecamatan($kabupaten_kode);
                if (!$kecamatans) {
                    return ['output' => '', 'selected' => ''];
                }

                $kec = [];

                foreach ($kecamatans as $kecamatan) {
                    $kec[] = ['id' => $kecamatan['kode_prov_kab_kecamatan'], 'name' => $kecamatan['nama']];
                }

                return ['output' => $kec, 'selected' => $kabupaten_kode];
            }
        }
    }
}
