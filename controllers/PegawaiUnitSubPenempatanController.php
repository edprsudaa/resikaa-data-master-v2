<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\PegawaiUnitPenempatan;
use app\models\PegawaiUnitSubPenempatan;
use app\models\PegawaiUnitSubPenempatanSearch;

/**
 * PegawaiUnitSubPenempatanController implements the CRUD actions for PegawaiUnitSubPenempatan model.
 */
class PegawaiUnitSubPenempatanController extends Controller
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
     * Lists all PegawaiUnitSubPenempatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiUnitSubPenempatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $unit = PegawaiUnitPenempatan::find()->where(['is_deleted' => null])->orderBy(['kode'=>SORT_ASC])->all();
        $atasan = PegawaiUnitSubPenempatan::find()->orderBy(['kode'=>SORT_ASC])->all();
        $model = new PegawaiUnitSubPenempatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

        } 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'unit' => $unit,
            'atasan' => $atasan,
            'model' => $model
        ]);
    }

    /**
     * Displays a single PegawaiUnitSubPenempatan model.
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
     * Creates a new PegawaiUnitSubPenempatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PegawaiUnitSubPenempatan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PegawaiUnitSubPenempatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PegawaiUnitSubPenempatan::find()->where(['kode'=>$id])->one();

        $model->kode = Yii::$app->request->post('kode');
        $model->nama = Yii::$app->request->post('nama');
        $model->kode_group = Yii::$app->request->post('kode_group');
        $model->kode_rumpun = Yii::$app->request->post('kode_rumpun');
        $model->aktif = Yii::$app->request->post('aktif');

        // echo '<pre>';
        // print_r($model);
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
     * Deletes an existing PegawaiUnitSubPenempatan model.
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
     * Finds the PegawaiUnitSubPenempatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PegawaiUnitSubPenempatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiUnitSubPenempatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
