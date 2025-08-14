<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\MedisAnatomi;
use app\models\MedisAnatomiSearch;
use yii\web\NotFoundHttpException;

/**
 * MedisAnatomiController implements the CRUD actions for MedisAnatomi model.
 */
class MedisAnatomiController extends Controller
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
     * Lists all MedisAnatomi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisAnatomiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new MedisAnatomi();
        $anatomiInduk = MedisAnatomi::AnatomiInduk();
        $anatomiall = $model->AnatomiAll();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'anatomiInduk' => $anatomiInduk,
            'model' => $model,
            'anatomiall' => $anatomiall,
        ]);
    }

    /**
     * Displays a single MedisAnatomi model.
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
     * Creates a new MedisAnatomi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisAnatomi();

        if ($model->load(Yii::$app->request->post())) {

            // echo '<pre>';
            // print_r($model);
            // die;

            $file_gambar = UploadedFile::getInstance($model, 'gambar_anatomi');

            if (!empty($file_gambar)) {
                $img = file_get_contents($file_gambar->tempName);
                $type = $file_gambar->type;
                $model->gambar_anatomi = 'data:' . $type . ';base64,' . base64_encode($img);
            }
            $model->is_active = 1;
            $model->save();

        }
       
    }

    /**
     * Updates an existing MedisAnatomi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $anatomiall = MedisAnatomi::AnatomiAll();

        if ($model->load(Yii::$app->request->post())) {
            $file_ba = UploadedFile::getInstance($model, 'gambar_anatomi');
            // var_dump($file_ba);
            // exit;
            if (!empty($file_ba)) {
                $img = file_get_contents($file_ba->tempName);
                $type = $file_ba->type;
                $model->gambar_anatomi = 'data:' . $type . ';base64,' . base64_encode($img);

                // var_dump($model->gambar_anatomi);
                // exit;
            }
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = 1;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_anatomi]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'anatomiall' => $anatomiall,
        ]);
    }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file_ba = UploadedFile::getInstance($model, 'gambar_anatomi');
            // var_dump($file_ba);
            // exit;
            if (!empty($file_ba)) {
                $img = file_get_contents($file_ba->tempName);
                $type = $file_ba->type;
                $model->gambar_anatomi = 'data:' . $type . ';base64,' . base64_encode($img);

                // var_dump($model->gambar_anatomi);
                // exit;
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_anatomi]);
            }
        }

        return $this->render('upload', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MedisAnatomi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'error' =>$model->getErrors()
            ];
        }  
    }

    /**
     * Finds the MedisAnatomi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisAnatomi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisAnatomi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
