<?php

namespace app\controllers;

use Yii;
use app\models\Visits;
use app\models\Events;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VisitsController implements the CRUD actions for Visits model.
 */
class VisitsController extends Controller
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

	/**
	 * Lists all Visits models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		// $dataProvider = new ActiveDataProvider([
		//     'query' => Visits::find(),
		// ]);

		// return $this->render('index', [
		//     'dataProvider' => $dataProvider,
		// ]);



		$vis = Visits::find()->orderBy(['visits.id'=>SORT_DESC])->joinWith('persons')->joinWith('events')->all();
		$vis_count = count($vis);

		//for ($i=1;$i<=$vis_count;$i++) 
		$visitword = $this->pluralForm($vis_count, 'визит', 'визита', 'визитов');


		return $this->render('index.twig', [
			'vis' => $vis, 'vis_count' => $vis_count, 'visitword' => $visitword,
		]);


	}

	/** Склонение существительных с числительными
	 * @param int $n число
	 * @param string $form1 Единственная форма: 1 секунда
	 * @param string $form2 Двойственная форма: 2 секунды
	 * @param string $form5 Множественная форма: 5 секунд
	 * @return string Правильная форма
	*/
		
	static function pluralForm($n, $form1, $form2, $form5) {
			$n = abs($n) % 100;
			$n1 = $n % 10;
			if ($n > 10 && $n < 20) return $form5;
			if ($n1 > 1 && $n1 < 5) return $form2;
			if ($n1 == 1) return $form1;
			return $form5;
	}


	/**
	 * Displays a single Visits model.
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
	 * Creates a new Visits model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Visits();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Visits model.
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
	 * Deletes an existing Visits model.
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
	 * Finds the Visits model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Visits the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Visits::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
