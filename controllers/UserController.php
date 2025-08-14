<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\components\Auth;
use app\models\Aplikasi;
use app\models\TbPegawai;
use app\models\AkunAknUser;
use yii\filters\VerbFilter;
use app\components\TipeAkun;
use app\components\HelperSso;
use yii\filters\AccessControl;
use app\models\AkunAknUserSearch;
use yii\web\NotFoundHttpException;
use app\models\akn_akses_aplikasi\SsoAknAksesAplikasi;

/**
 * UserController implements the CRUD actions for AkunAknUser model.
 */
class UserController extends Controller
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
						'actions' => ['login', 'error', 'create', 'get-pegawai', 'view', 'update', 'delete', 'reset-password', 'koreksi-data'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}


	public function actionIndex()
	{
		$searchModel = new AkunAknUserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model = new AkunAknUser();

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'model' => $model,
		]);
	}

	
	public function actionView($id)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
        $data = $this->findModel($id);

        return [
            'status' => 200,
            'message' => 'Data Berhasil Ditampilkan.',
            'data'  => $data
        ];
	}

	public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new AkunAknUser();
       
        if ($model->load(Yii::$app->request->post())) {
			
            $model->username = str_replace(" ", "", $model->username);
            $model->status = 0; //0 = AKTIF, 1 = TIDAK AKTIF
			$model->password = md5(str_replace(" ", "", $model->username));
            $model->tanggal_pendaftaran = date('Y-m-d H:i:s');
           
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

			if($data['status'] == 1){	//0 = AKTIF, 1 = TIDAK AKTIF
                $model->tanggal_nonaktif = date('Y-m-d H:i:s');
            }else{
                $model->tanggal_nonaktif = null;
            }

            $model->role = $data['role'];
            $model->status = $data['status'];
            $model->nama = $data['nama'];
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

	public function actionGetPegawai($id)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;       
       
		$data = TbPegawai::find()->where(['pegawai_id' => $id])->one();

		return [
            'status' => 200,
            'message' => 'Data Berhasil Ditampilkan.',
            'data'  => $data
        ];
	}

	public function actionResetPassword($id)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$model = $this->findModel($id);

		if (Yii::$app->request->isAjax && Yii::$app->request->post()) {

			$data = Yii::$app->request->post();

			$model->password = md5($data['username']);
		
			if ($model->save()) {
                return [
                    'status' => 200,
                    'message' => 'Password Berhasil Direset.',
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

	public function actionKoreksiData()
	{
		$akn_user = AkunAknUser::find()->all();
		return $this->render('koreksi-data', ['user' => $akn_user]);
	}

	/**
	 * Finds the AkunAknUser model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return AkunAknUser the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = AkunAknUser::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
