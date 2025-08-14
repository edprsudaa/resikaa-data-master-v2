<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\PegawaiStatusKepegawaian;
use app\models\PegawaiStatusKepegawaianSearch;

/**
 * PegawaiStatusKepegawaianController implements the CRUD actions for PegawaiStatusKepegawaian model.
 */
class PegawaiStatusKepegawaianController extends Controller
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
     * Lists all PegawaiStatusKepegawaian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PegawaiStatusKepegawaian();
        $searchModel = new PegawaiStatusKepegawaianSearch();
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
     * Displays a single PegawaiStatusKepegawaian model.
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

  
    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->status = Yii::$app->request->post('status');
        $model->kategori = Yii::$app->request->post('kategori');

        if ($model->save()) {
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

  
     public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id);
         
        if ($model->delete()) {
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
     * Finds the PegawaiStatusKepegawaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PegawaiStatusKepegawaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PegawaiStatusKepegawaian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
