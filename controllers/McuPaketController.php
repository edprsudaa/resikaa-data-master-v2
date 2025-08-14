<?php

namespace app\controllers;

use Yii;
use app\models\McuPaket;
use app\models\McuPaketSearch;
use app\models\McuPaketTindakanMcu;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * McuPaketController implements the CRUD actions for McuPaket model.
 */
class McuPaketController extends Controller
{
    /**
     * @inheritdoc
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
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all McuPaket models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new McuPaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new McuPaket();  

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }


    /**
     * Displays a single McuPaket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $paket_tindakan = McuPaketTindakanMcu::find()->where(['kode_paket'=>$id])->orderBy(['id'=> SORT_ASC])->all();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "McuPaket #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                        'paket_tindakan' => $paket_tindakan,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'paket_tindakan' => $paket_tindakan,
            ]);
        }
    }

    public function actionCreate()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new McuPaket();

        $model->nama       = Yii::$app->request->post('nama');
        $model->jenis_paket       = Yii::$app->request->post('jenis_paket');
        $model->is_active       = 1;

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

    public function actionUpdate($id)
    {
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        $model->is_active = Yii::$app->request->post('is_active');
        $model->nama = Yii::$app->request->post('nama');
        $model->jenis_paket = Yii::$app->request->post('jenis_paket');

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
                'errors'  => $model->getErrors()
            ];
        }  
    }


   
    protected function findModel($id)
    {
        if (($model = McuPaket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
