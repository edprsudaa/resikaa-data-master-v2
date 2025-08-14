<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\Controller;
use app\models\Provinsi;
use app\models\Kabupaten;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\KabupatenSearch;
use yii\web\NotFoundHttpException;

/**
 * KabupatenController implements the CRUD actions for Kabupaten model.
 */
class KabupatenController extends Controller
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
     * Lists all Kabupaten models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KabupatenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Kabupaten();
        $provinsi = Provinsi::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'     => $model,
            'provinsi' => $provinsi
        ]);
    }

    /**
     * Displays a single Kabupaten model.
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
     * Creates a new Kabupaten model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Kabupaten();

        $cekKodeKab = Kabupaten::find()->where(['kode_prov_kabupaten' => Yii::$app->request->post('kode_prov_kab') ])->andWhere(['is_deleted' => null])->one();

        if(!empty($cekKodeKab)){
             return [
                'status'    => 1,
                'message' => 'Kode Kabupaten Telah Digunakan.',
                'data'  => $cekKodeKab
            ];
        }

        if (Yii::$app->request->post()) {
            $model->kode_prov_kabupaten = Yii::$app->request->post('kode_prov_kab');
            $model->nama = Yii::$app->request->post('nama');
            $model->jenis = Yii::$app->request->post('jenis');
            $model->kode_prov = Yii::$app->request->post('kode_prov');
            $model->aktif = 1;
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
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;      

        if (Yii::$app->request->post()) {
            $model->kode_prov_kabupaten = Yii::$app->request->post('kode_kabupaten');
            $model->nama = Yii::$app->request->post('nama');
            $model->jenis = Yii::$app->request->post('jenis');
            $model->kode_prov = Yii::$app->request->post('kode_prov');
            $model->aktif = Yii::$app->request->post('aktif');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;


            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => 'Data Berhasil Diubah.',
                    'data'  => $model
                ];
            }else{
                $errors = $model->getErrors();
                return [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat Mengubah Data.',
                    'data'  => $errors
                ];
            }
            
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
        if (($model = Kabupaten::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetKabupatenByProvinsi()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       
        $post = Yii::$app->request->post();

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $provinsi_kode = $parents[0];

                $kabupatens = Kabupaten::getKabupaten($provinsi_kode);
                if (!$kabupatens) {
                    return ['output' => '', 'selected' => ''];
                }

                $kab = [];

                foreach ($kabupatens as $kabupaten) {
                    $kab[]=['id'=>$kabupaten['kode_prov_kabupaten'], 'name'=>$kabupaten['nama']];
                }

                return ['output'=>$kab, 'selected'=>$provinsi_kode];
                
            }
        }
        
    }

    

}
