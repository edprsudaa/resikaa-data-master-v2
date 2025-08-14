<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;
use app\models\TindKelas;
use app\models\TindKelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * TindKelasController implements the CRUD actions for TindKelas model.
 */
class TindKelasController extends Controller
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
     * Lists all TindKelas models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new TindKelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single TindKelas model.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @param string $KodeKelas
     * @return mixed
     */
    public function actionView($KDKEL, $KODE1, $KODE2, $KodeKelas)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "TindKelas #".$KDKEL, $KODE1, $KODE2, $KodeKelas,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($KDKEL, $KODE1, $KODE2, $KodeKelas),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','KDKEL, $KODE1, $KODE2, $KodeKelas'=>$KDKEL, $KODE1, $KODE2, $KodeKelas],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($KDKEL, $KODE1, $KODE2, $KodeKelas),
            ]);
        }
    }

    /**
     * Creates a new TindKelas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new TindKelas();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new TindKelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new TindKelas",
                    'content'=>'<span class="text-success">Create TindKelas success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new TindKelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
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
                return $this->redirect(['view', 'KDKEL' => $model->KDKEL, 'KODE1' => $model->KODE1, 'KODE2' => $model->KODE2, 'KodeKelas' => $model->KodeKelas]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing TindKelas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @param string $KodeKelas
     * @return mixed
     */
    public function actionUpdate($KDKEL, $KODE1, $KODE2, $KodeKelas)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($KDKEL, $KODE1, $KODE2, $KodeKelas);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update TindKelas #".$KDKEL, $KODE1, $KODE2, $KodeKelas,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "TindKelas #".$KDKEL, $KODE1, $KODE2, $KodeKelas,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','KDKEL, $KODE1, $KODE2, $KodeKelas'=>$KDKEL, $KODE1, $KODE2, $KodeKelas],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update TindKelas #".$KDKEL, $KODE1, $KODE2, $KodeKelas,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                return $this->redirect(['view', 'KDKEL' => $model->KDKEL, 'KODE1' => $model->KODE1, 'KODE2' => $model->KODE2, 'KodeKelas' => $model->KodeKelas]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing TindKelas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @param string $KodeKelas
     * @return mixed
     */
    public function actionDelete($KDKEL, $KODE1, $KODE2, $KodeKelas)
    {
        $request = Yii::$app->request;
        $this->findModel($KDKEL, $KODE1, $KODE2, $KodeKelas)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing TindKelas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @param string $KodeKelas
     * @return mixed
     */
    // public function actionBulkDelete()
    // {        
    //     $request = Yii::$app->request;
    //     $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
    //     foreach ( $pks as $pk ) {
    //         $model = $this->findModel($pk);
    //         $model->delete();
    //     }

    //     if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         return $this->redirect(['index']);
    //     }
       
    // }

    /**
     * Finds the TindKelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $KDKEL
     * @param string $KODE1
     * @param string $KODE2
     * @param string $KodeKelas
     * @return TindKelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($KDKEL, $KODE1, $KODE2, $KodeKelas)
    {
        if (($model = TindKelas::findOne(['KDKEL' => $KDKEL, 'KODE1' => $KODE1, 'KODE2' => $KODE2, 'KodeKelas' => $KodeKelas])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
