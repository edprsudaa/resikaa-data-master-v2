<?php

namespace app\controllers;

use app\models\DOKTER;
use Yii;
use app\models\McuDokterPaketTindakanMcu;
use app\models\McuDokterPaketTindakanMcuSearch;
use app\models\McuPaket;
use app\models\McuPaketTindakanMcu;
use app\models\UNIT;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * McuDokterPaketTindakanMcuController implements the CRUD actions for McuDokterPaketTindakanMcu model.
 */
class McuDokterPaketTindakanMcuController extends Controller
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
     * Lists all McuDokterPaketTindakanMcu models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new McuDokterPaketTindakanMcuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dokter = DOKTER::find()->all();
        $paket = McuPaket::find()->all();
        $paket_tindakan = McuPaketTindakanMcu::find()->all();
        $unit = UNIT::find()->orderBy(['KD_INST'=> SORT_ASC])->all();
        $model = new McuDokterPaketTindakanMcu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // echo '<pre>';
            // print_r($model);die;
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

        } 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dokter' => $dokter,
            'paket' => $paket,
            'paket_tindakan' => $paket_tindakan,
            'unit' => $unit,
            'model' => $model,
        ]);
    }


    /**
     * Displays a single McuDokterPaketTindakanMcu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "McuDokterPaketTindakanMcu #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new McuDokterPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new McuDokterPaketTindakanMcu();
        $dokter = DOKTER::find()->orderBy(['KODE'=> SORT_ASC])->all();
        $tindakan = new McuPaketTindakanMcu();
        $paket_tindakan = $tindakan->getPaketTindakan();
        $paket = McuPaket::find()->all();
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new McuDokterPaketTindakanMcu",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dokter' => $dokter,
                        'paket_tindakan' => $paket_tindakan,
                        'paket' => $paket,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new McuDokterPaketTindakanMcu",
                    'content'=>'<span class="text-success">Create McuDokterPaketTindakanMcu success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new McuDokterPaketTindakanMcu",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'dokter' => $dokter,
                        'paket_tindakan' => $paket_tindakan,
                        'paket' => $paket,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'dokter' => $dokter,
                    'paket_tindakan' => $paket_tindakan,
                    'paket' => $paket,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing McuDokterPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dokter = DOKTER::find()->orderBy(['KODE'=> SORT_ASC])->all();   
        $tindakan = new McuPaketTindakanMcu();
        $paket_tindakan = $tindakan->getPaketTindakan();
        $paket = McuPaket::find()->all();   

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update McuDokterPaketTindakanMcu #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dokter' => $dokter,
                        'paket_tindakan' => $paket_tindakan,
                        'paket' => $paket,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if ($model->load(Yii::$app->request->post()) ) {
                $date = date('Y-m-d H:i:s');
                $model->updated_at =$date;
                // $model->updated_by = Yii::$app->user->identity->kodeAkun;
                if ($model->save()) {  
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "McuDokterPaketTindakanMcu #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                            'dokter' => $dokter,
                            'paket_tindakan' => $paket_tindakan,
                            'paket' => $paket,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];   
                } 
            }else{
                 return [
                    'title'=> "Update McuDokterPaketTindakanMcu #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'dokter' => $dokter,
                        'paket_tindakan' => $paket_tindakan,
                        'paket' => $paket,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'dokter' => $dokter,
                    'paket_tindakan' => $paket_tindakan,
                    'paket' => $paket,
                ]);
            }
        }
    }

    /**
     * Delete an existing McuDokterPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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
            $errors = $model->getErrors();      
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah data.',
                'data'  => $errors
            ];

        }
    }

     /**
     * Delete multiple existing McuDokterPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    /**
     * Finds the McuDokterPaketTindakanMcu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return McuDokterPaketTindakanMcu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = McuDokterPaketTindakanMcu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // public function actionGetPaketTindakan() {
    //     $out = [];
    //     if (isset($_POST['depdrop_parents'])) {
    //         $parents = $_POST['depdrop_parents'];
    //         if ($parents != null) {
    //             $kode = $parents[0];
    //             $out = McuPaketTindakanMcu::getOptionsbyPaketTindakan($kode);
    //             echo Json::encode(['output' => $out, 'selected' => '']);
    //             //return;
    //             exit;
    //         }
    //     }
    //     echo Json::encode(['output' => '', 'selected' => '']);
    // }
}
