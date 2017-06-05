<?php

namespace app\controllers;

use Yii;
use app\models\Tickets;
use app\models\Events;
use app\models\Persons;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
{
	/**
	 * @inheritdoc
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
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index', 'create', 'view', 'update', 'delete'],
				'rules' => [
					[
						'allow' => false,
						'actions' => ['index', 'create', 'view', 'update', 'delete'],
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'actions' => ['index', 'create', 'view', 'update', 'delete'],
						'roles' => ['@'],
					],
				],
			],
		];
	}

	public $enableCsrfValidation = false;

	/**
	 * Lists all Tickets models.
	 * @return mixed
	 */
	public function actionIndex()
	{

		$tickets = Tickets::find()->joinWith('persons')->joinWith('events')->orderBy(['id'=>SORT_DESC])->all();
		$vis_count = count($tickets);
		$visitword = $this->pluralForm($vis_count, 'билет', 'билета', 'билетов');

// var_dump($tickets);
// return;
		return $this->render('index.twig', [
			'tickets' => $tickets, 'vis_count' => $vis_count, 'visitword' => $visitword,
		]);

	}


	static function pluralForm($n, $form1, $form2, $form5) {
			$n = abs($n) % 100;
			$n1 = $n % 10;
			if ($n > 10 && $n < 20) return $form5;
			if ($n1 > 1 && $n1 < 5) return $form2;
			if ($n1 == 1) return $form1;
			return $form5;
	}



	public function actionTicket($uid){

		$ticket = new Tickets();
		$ticket->user_id = $uid;
		$ticket->event_id = $_POST['event_id'];
		$ticket->date = date("Y-m-d H:i:s");
		$ticket->money = $_POST['money'];
		$ticket->info = $_POST['info'];
		if(isset($_POST['type'])){
			if($_POST['type'] == 'Наличка'){
				$ticket->type = 1;   
			}
			else if($_POST['type'] == 'БезНал'){
				$ticket->type = 2;   
			}
			else{
				$ticket->type = 3;   
			}
		}
		$ticket->save();
		
		return $this->redirect(['persons/index']);
	}




	/**
	 * Displays a single Tickets model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Tickets model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Tickets();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Tickets model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Tickets model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Tickets model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Tickets the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Tickets::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
