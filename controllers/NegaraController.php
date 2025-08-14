<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\Negara;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\NegaraSearch;
use yii\filters\AccessControl;
use aryelds\sweetalert\SweetAlert;
use yii\web\NotFoundHttpException;

/**
 * NegaraController implements the CRUD actions for Negara model.
 */
class NegaraController extends Controller
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
                        //'actions' => ['create', 'logout', 'index'],
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
     * Lists all Negara models.
     * @return mixed
     */
    public function actionIndex()
    {   
        $model = new Negara();
        $searchModel = new NegaraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

          
        } 

        return $this->render('index', [
            'model'         => $model,
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }

    /**
     * Displays a single Negara model.
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
     * Creates a new Negara model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Negara();

        $model->nama       = Yii::$app->request->post('nama');
        $model->kode       = Yii::$app->request->post('kode');
        $model->aktif      = 1;
        $model->created_at = date('Y-m-d H:i:s');        
        $model->created_by = Yii::$app->user->identity->id;

        // echo '<pre>';
        // print_r($model);
        // die;

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

    /**
     * Updates an existing Negara model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->nama = Yii::$app->request->post('nama');
        $model->kode = Yii::$app->request->post('kode');
        $model->aktif = Yii::$app->request->post('aktif');

        // echo '<pre>';
        // print_r(Yii::$app->request->post());
        // die;

        if (Yii::$app->request->post() && $model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Diubah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.'
            ];
        }
            
       

    }

    /**
     * Deletes an existing Negara model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id);
         
        $model->is_deleted =1;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Dihapus.'
            ];

        }else{                    
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.'
            ];
        }  
    }

    /**
     * Finds the Negara model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Negara the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Negara::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
