<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\models\AksesUnit;
use app\models\AkunAknUser;
use yii\filters\VerbFilter;
use app\models\AksesUnitSearch;
use yii\web\NotFoundHttpException;

/**
 * AksesUnitController implements the CRUD actions for AksesUnit model.
 */
class AksesUnitController extends Controller
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
     * Lists all AksesUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AksesUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new AksesUnit();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single AksesUnit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
	{
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = AksesUnit::find()
            ->with('pengguna.dataPegawai','unitPenempatan')
            ->where(['id' => $id])
            ->one();

        if (empty($data)) {
            return [
                'status' => 404,
                'message' => 'Data tidak ditemukan.'
            ];
        }else{

            return [
                'status' => 200,
                'message' => 'Data berhasil ditampilkan.',
                'data' => $data->toArray([], ['pengguna.dataPegawai', 'unitPenempatan'])
                
            ];
        }

        
	}
   

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new AksesUnit();
       
        if ($model->load(Yii::$app->request->post())) {
			
            $model->tanggal_aktif = date('Y-m-d H:i:s');
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
           
            if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Data Berhasil Ditambah.',
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

    public function actionUpdate($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
       
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {

            $data = Yii::$app->request->post();

            if($data['aktif'] == 0){
                $model->tanggal_nonaktif = date('Y-m-d H:i:s');
            }else{
                $model->tanggal_nonaktif = null;
            }

            $model->unit_id = $data['unit_id'];
            $model->pengguna_id = $data['pengguna_id'];
            $model->id_aplikasi = $data['id_aplikasi'];
            $model->aktif = $data['aktif'];
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;

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

        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Yii::$app->user->identity->id;

        if ($model->save()) {
            return [
                'status' => 200,
                'message' => 'Data Berhasil Dihapus.',
                'data'  => $model
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
    

    /**
     * Finds the AksesUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AksesUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AksesUnit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
