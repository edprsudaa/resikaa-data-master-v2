<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;
use app\models\MedisIcd9cm;
use app\models\MedisIcd9cmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MedisIcd9cmController implements the CRUD actions for MedisIcd9cm model.
 */
class MedisIcd9cmController extends Controller
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
     * Lists all MedisIcd9cm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedisIcd9cmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $mod_icd9cm = new MedisIcd9cm();
        $icd9cm = $mod_icd9cm->getIcd9Cm();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'icd9cm' => $icd9cm,
        ]);
    }

    /**
     * Displays a single MedisIcd9cm model.
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
     * Creates a new MedisIcd9cm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MedisIcd9cm();
        $mod_icd9cm = new MedisIcd9cm();
        $icd9cm = $mod_icd9cm->getIcd9Cm();

        $q = Yii::$app->request;
        if ($model->load($q->post())) {
            $model->created_by = 1;
            try {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            $model->aktif = 1;
        }

        return $this->render('create', [
            'model' => $model,
            'icd9cm' => $icd9cm,
        ]);
    }

    /**
     * Updates an existing MedisIcd9cm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mod_icd9cm = new MedisIcd9cm();
        $icd9cm = $mod_icd9cm->getIcd9Cm();

        if ($model->load(Yii::$app->request->post())) {
            $date = date('Y-m-d H:i:s');
            $model->updated_at = $date;
            $model->updated_by = 1;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'icd9cm' => $icd9cm,
        ]);
    }

    /**
     * Deletes an existing MedisIcd9cm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $date = date('Y-m-d H:i:s');
        $model = $this->findModel($id);
         
        $model->is_deleted ='1';
        $model->updated_at =$date;
        // $model->updated_by = Yii::$app->user->identity->kodeAkun;
        if ($model->save()) {
            return $this->redirect(['index']);
        } 
    }

    /**
     * Finds the MedisIcd9cm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedisIcd9cm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedisIcd9cm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
