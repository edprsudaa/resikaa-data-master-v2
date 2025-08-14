<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\models\DboVWTARIF;
use app\models\McuPaket;
use Yii;
use app\models\McuPaketTindakanMcu;
use app\models\McuPaketTindakanMcuSearch;
use app\models\UNIT;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * McuPaketTindakanMcuController implements the CRUD actions for McuPaketTindakanMcu model.
 */
class McuPaketTindakanMcuController extends Controller
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
     * Lists all McuPaketTindakanMcu models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new McuPaketTindakanMcuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $paket = McuPaket::find()->all();
        $unit = UNIT::find()->all();
        $model = new McuPaketTindakanMcu();  

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return [
                'success' => true,
                'message' => 'Data Berhasil Ditambah.'
            ];

        } 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'paket' => $paket,
            'unit' => $unit,
            'model' => $model,
        ]);
    }


    /**
     * Displays a single McuPaketTindakanMcu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "McuPaketTindakanMcu #".$id,
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
     * Creates a new McuPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $request = Yii::$app->request;
    //     $model = new McuPaketTindakanMcu();  
    //     $paket = McuPaket::find()->orderBy(['kode'=> SORT_ASC])->all();
    //     $unit = UNIT::find()->orderBy(['KD_INST'=> SORT_ASC])->all();

    //     if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         if($request->isGet){
    //             return [
    //                 'title'=> "Create new McuPaketTindakanMcu",
    //                 'content'=>$this->renderAjax('create', [
    //                     'model' => $model,
    //                     'paket' => $paket,
    //                     'unit' => $unit,
    //                 ]),
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                             Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
    //             ];         
    //         }else if($model->load($request->post()) && $model->save()){
    //             return [
    //                 'forceReload'=>'#crud-datatable-pjax',
    //                 'title'=> "Create new McuPaketTindakanMcu",
    //                 'content'=>'<span class="text-success">Create McuPaketTindakanMcu success</span>',
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                         Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
    //             ];         
    //         }else{           
    //             return [
    //                 'title'=> "Create new McuPaketTindakanMcu",
    //                 'content'=>$this->renderAjax('create', [
    //                     'model' => $model,
    //                     'paket' => $paket,
    //                     'unit' => $unit,
    //                 ]),
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                             Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
    //             ];         
    //         }
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         if ($model->load($request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         } else {
    //             return $this->render('create', [
    //                 'model' => $model,
    //                 'paket' => $paket,
    //                 'unit' => $unit,
    //             ]);
    //         }
    //     }
       
    // }

    /**
     * Updates an existing McuPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $paket = McuPaket::find()->orderBy(['kode'=> SORT_ASC])->all();
        $unit = UNIT::find()->orderBy(['KD_INST'=> SORT_ASC])->all();      

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update McuPaketTindakanMcu #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'paket' => $paket,
                        'unit' => $unit,
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
                        'title'=> "McuPaketTindakanMcu #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                            'paket' => $paket,
                            'unit' => $unit,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ]; 
                }   
            }else{
                 return [
                    'title'=> "Update McuPaketTindakanMcu #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'paket' => $paket,
                        'unit' => $unit,
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
                    'paket' => $paket,
                    'unit' => $unit,
                ]);
            }
        }
    }

    /**
     * Delete an existing McuPaketTindakanMcu model.
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
     * Delete multiple existing McuPaketTindakanMcu model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    /**
     * Finds the McuPaketTindakanMcu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return McuPaketTindakanMcu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = McuPaketTindakanMcu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionTarifList($q = null, $d =null) {
        // print_r($d);
        // die();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data_kode_tindakan=McuPaketTindakanMcu::find()->select(['kode_tindakan'])->where(['kode_paket'=>$d])->asArray()->all();
            $s_data_kode_tindakan = implode(',', ArrayHelper::getColumn($data_kode_tindakan, function ($element) {
                return "'".$element['kode_tindakan']."'";
            }));
            if (!empty($s_data_kode_tindakan)) {
                // echo'<pre/>';print_r($s_data_kode_tindakan);die();
                $data=Yii::$app->dbSimrsOld->createCommand("SELECT DISTINCT  KodeJenis AS id,KodeJenis+' | '+ket1 AS text FROM TARIF WHERE ( ket1 LIKE '%".$q."%' OR KodeJenis LIKE '%".$q."%') AND KodeJenis NOT IN (".$s_data_kode_tindakan.")")->queryAll();
                $out['results'] = array_values($data);
            }else{
                $data=Yii::$app->dbSimrsOld->createCommand("SELECT DISTINCT  KodeJenis AS id,KodeJenis+' | '+ket1 AS text FROM TARIF WHERE ket1 LIKE '%".$q."%' OR KodeJenis LIKE '%".$q."%'")->queryAll();
                $out['results'] = array_values($data);
            }
        }
        return $out;
    }

    // public function actionTarifList($q = null, $d = null) {
    //     // print_r($d);
    //     // die();
    //     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //     $out = ['results' => ['id' => '', 'text' => '']];
    //     if (!is_null($q)) {
    //             // $data_kode_tindakan=McuPaketTindakanMcu::find()->select(['kode_tindakan'])->asArray()->all();
    //             $data_kode_tindakan=McuPaketTindakanMcu::find()->select('kode_tindakan')->where(['kode_paket'=>$d])->all();

    //             $array = [];
    //             foreach ($data_kode_tindakan as $v) {
    //             $array[] = $v->kode_tindakan;
    //             }
                
    //             $data=Yii::$app->dbSimrsOld->createCommand("SELECT DISTINCT  KodeJenis AS id,KodeJenis+' | '+ket1 AS text FROM TARIF WHERE ket1 LIKE '%".$q."%' OR KodeJenis LIKE '%".$q."%' AND KodeJenis NOT IN $array")->queryAll();
    //             $out['results'] = array_values($data);
    //     }
    //     return $out;
    // }

    public function actionJmlTarif(){
        $kodenya=$_POST['kode'];
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data=Yii::$app->dbSimrsOld->createCommand("SELECT (Harga_Bhn+Js_RS+Js_MedRS+Js_MedL+Js_MedTL+Js_KSO) as harga, ket1 FROM TARIF WHERE Kodejenis='$kodenya'")->queryOne();
        //$data = ::find()->where(['kode'=>$_POST['kode']])->asArray()->one();
        //var_dump($data);exit;
        $hasil=explode(".",$data['harga']);
        //print_r ($hasil[0]);
        $datanya = [$data['ket1'], $hasil[0]];
        // print_r ($datanya);
        return $datanya;
    }
}
