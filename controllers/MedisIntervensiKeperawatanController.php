<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\models\MedisIntervensiKeperawatan;
use app\models\MedisIntervensiKeperawatanSearch;

/**
 * MedisIntervensiKeperawatanController implements the CRUD actions for MedisIntervensiKeperawatan model.
 */
class MedisIntervensiKeperawatanController extends Controller
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
     * Lists all MedisIntervensiKeperawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisIntervensiKeperawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new MedisIntervensiKeperawatan();
        $intervensi_keperawatan = $model->getIntervensiKeperawatan();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'intervensi_keperawatan' => $intervensi_keperawatan,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single MedisIntervensiKeperawatan model.
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
     * Creates a new MedisIntervensiKeperawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new MedisIntervensiKeperawatan();

        Yii::$app->response->format = Response::FORMAT_JSON;

        $model->parent_id = Yii::$app->request->post('parent');
        $model->deskripsi = Yii::$app->request->post('deskripsi');
        $model->aktif     = 1;

        $model->created_at = date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->identity->id;
        $model->is_deleted = 0;

        // echo '<pre>';
        // print_r($model);die;

        if ($model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat Menambahkan Data.'
            ];
        }
     
    }

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $model->parent_id   = Yii::$app->request->post('parent');
        $model->deskripsi   = Yii::$app->request->post('deskripsi');
        $model->aktif       = Yii::$app->request->post('aktif');

        $model->updated_at   = date('Y-m-d H:i:s');
        $model->updated_by   = Yii::$app->user->identity->id;       

        if (Yii::$app->request->post() && $model->save()) {
            return [
                'success' => true,
                'message' => 'Data Berhasil Diubah.'
            ];
        }else{
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'error' =>$model->getErrors()
            ];
        }           
       

    }
  
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; 
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;

        // print_r($model);die;
         
        if ($model->save()) {
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
     * Finds the MedisIntervensiKeperawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisIntervensiKeperawatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisIntervensiKeperawatan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
