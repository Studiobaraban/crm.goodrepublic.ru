<?php

namespace app\controllers;

use Yii;
use app\models\Abonements;
use app\models\Persons;
use app\models\Visits;
use app\models\Tickets;
use app\models\Events;
use app\models\Goods;
use app\models\Sells;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

date_default_timezone_set('Europe/Moscow');


/**
 * PersonsController implements the CRUD actions for Persons model.
 */
class PersonsController extends Controller
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
		'only' => ['index', 'create', 'view', 'update', 'delete', 'statistics'],
		'rules' => [
		[
		'allow' => false,
		'actions' => ['index', 'create', 'view', 'update', 'delete', 'statistics'],
		'roles' => ['?'],
		],
		[
		'allow' => true,
		'actions' => ['index', 'create', 'view', 'update', 'delete', 'statistics'],
		'roles' => ['@'],
		],
		],
		],
		];
	}



	/**
	 * Lists all Persons models.
	 * @return mixed
	 */

	public $enableCsrfValidation = false;
	
	public function actionIndex()
	{
		//Получаем список кто пришел + кол-во визитов (таблицы связаны через модель)
		$inside = Persons::find()->joinWith('visits')->joinWith('abonements')->where(['or',['inside' => 1],['inside' => 2]])->orderBy(['visits.start'=>SORT_DESC])->all();
		//Получаем список кого нет + кол-во визитов (таблицы связаны через модель)
		$today = Persons::find()->joinWith('visits')->where(['inside'=> 0])->andwhere('DATE(start) = DATE(NOW())')->orderBy(['start'=>SORT_ASC])->all();



		$summnal1 = Visits::find()->where(['type' => 1])->andwhere('DATE(end) = DATE(NOW())')->sum('money');
		$summbez1 = Visits::find()->where(['type' => 2])->andwhere('DATE(end) = DATE(NOW())')->sum('money');
		$summpad1 = Visits::find()->where(['type' => 3])->andwhere('DATE(end) = DATE(NOW())')->sum('money');
		$summgr1 = Visits::find()->where(['type' => 4])->andwhere('DATE(end) = DATE(NOW())')->sum('money');

		$summnal2 = Sells::find()->where(['type' => 1])->andwhere('DATE(date) = DATE(NOW())')->sum('itogo');
		$summbez2 = Sells::find()->where(['type' => 2])->andwhere('DATE(date) = DATE(NOW())')->sum('itogo');
		$summgr2 = Sells::find()->where(['type' => 4])->andwhere('DATE(date) = DATE(NOW())')->sum('itogo');

		$summnal3 = Tickets::find()->where(['type' => 1])->andwhere('DATE(date) = DATE(NOW())')->sum('money');
		$summbez3 = Tickets::find()->where(['type' => 2])->andwhere('DATE(date) = DATE(NOW())')->sum('money');
		$summpad3 = Tickets::find()->where(['type' => 3])->andwhere('DATE(date) = DATE(NOW())')->sum('money');
		$summgr3 = Tickets::find()->where(['type' => 4])->andwhere('DATE(date) = DATE(NOW())')->sum('money');

		$summnal = $summnal1 + $summnal2 + $summnal3;
		$summbez = $summbez1 + $summbez2 + $summbez3;
		$summpad = $summpad1 + $summpad3;
		$summgr = $summgr1 + $summgr2 + $summgr3;

		return $this->render('index.twig', [
			'inside' => $inside, 'today' => $today, 'summnal' => $summnal, 'summbez' => $summbez, 'summpad' => $summpad
			]);
	}



	/**
	 * Lists all Persons models.
	 * @return mixed
	 */
	
	public function actionAllpersons()
	{
		$outs = Persons::find()->joinWith('visits')->joinWith('abonements')->where(['inside' => 0])->orderBy(['visits.start'=>SORT_DESC])->all();

		return $this->render('allpersons.twig', [
			'outs' => $outs
			]);
	}




	public function actionStatistics()
	{

		$visitsall = Visits::findBySql('
			SELECT
			CAST(start AS DATE) as start, 
			SUM(CASE WHEN type = 1 THEN money ELSE 0 END) as type,
			SUM(CASE WHEN type = 2 THEN money ELSE 0 END) as user_id,
			SUM(CASE WHEN type = 3 THEN money ELSE 0 END) as event_id,
			SUM(CASE WHEN type = 4 THEN money ELSE 0 END) as discount_money,
			SUM(money) - SUM(CASE WHEN type = 4 THEN money ELSE 0 END) as money
			FROM visits GROUP BY CAST(start AS DATE) Order BY start DESC')->all();

		$ticketsall = Tickets::findBySql('
			SELECT
			CAST(date AS DATE) as date, 
			SUM(CASE WHEN type = 1 THEN money ELSE 0 END) as type,
			SUM(CASE WHEN type = 2 THEN money ELSE 0 END) as user_id,
			SUM(CASE WHEN type = 3 THEN money ELSE 0 END) as event_id,
			SUM(CASE WHEN type = 4 THEN money ELSE 0 END) as id,
			SUM(money) - SUM(CASE WHEN type = 4 THEN money ELSE 0 END) as money
			FROM tickets GROUP BY CAST(date AS DATE) Order BY date DESC')->all();


		$sellsall = Sells::findBySql('
			SELECT
			CAST(date AS DATE) as date, 
			SUM(CASE WHEN type = 1 THEN itogo ELSE 0 END) as type,
			SUM(CASE WHEN type = 2 THEN itogo ELSE 0 END) as price,
			SUM(CASE WHEN type = 3 THEN itogo ELSE 0 END) as count,
			SUM(CASE WHEN type = 4 THEN itogo ELSE 0 END) as good_id,
			SUM(itogo) - SUM(CASE WHEN type = 4 THEN itogo ELSE 0 END) as itogo
			FROM sells GROUP BY CAST(date AS DATE) Order BY date DESC')->all();



		$result = array();
		foreach ($visitsall as $row) {
			
			$ticket_money = 0;
			foreach ($ticketsall as $tick) {
				if($tick['date'] == $row['start']){
					$ticket_money = $tick['money'];
					break;
				}
			}

			$sells_itogo = 0;
			foreach ($sellsall as $sell) {
				if($sell['date'] == $row['start']){
					$sells_itogo = $sell['itogo'];
					break;
				}
			}

			$result[] = [$row['start'], $row['money'], $ticket_money, $sells_itogo, $row['money'] + $ticket_money + $sells_itogo];
		}



		$visitsallmonth = Visits::findBySql('
			SELECT
			Year(start) as type, Month(start) as start,
			Sum(money) - SUM(CASE WHEN type = 4 THEN money ELSE 0 END) as money
			FROM visits Group By Year(start), Month(start) Order BY start DESC')->all();


		$ticketsallmonth = Tickets::findBySql('
			SELECT
			Year(date) as type, Month(date) as date,
			Sum(money) - SUM(CASE WHEN type = 4 THEN money ELSE 0 END) as money
			FROM tickets Group By Year(date), Month(date) Order BY date DESC')->all();


		$sellsallmonth = Sells::findBySql('
			SELECT
			Year(date) as type, Month(date) as date,
			Sum(itogo) - SUM(CASE WHEN type = 4 THEN itogo ELSE 0 END) as itogo
			FROM sells Group By Year(date), Month(date) Order BY date DESC')->all();




		$resultmonth = array();
		foreach ($visitsallmonth as $row) {
			
			$ticket_money = 0;
			foreach ($ticketsallmonth as $tick) {
				if($tick['date'] == $row['start']){
					$ticket_money = $tick['money'];
					break;
				}
			}

			$sells_itogo = 0;
			foreach ($sellsallmonth as $sell) {
				if($sell['date'] == $row['start']){
					$sells_itogo = $sell['itogo'];
					break;
				}
			}

			$resultmonth[] = [$row['start'], $row['money'], $ticket_money, $sells_itogo, $row['money'] + $ticket_money + $sells_itogo];
		}


		$sells = Sells::findBySql('
			SELECT
				sells.good_id,
				goods.name,
				SUM(sells.count) as count,
				SUM(sells.itogo) as itogo
				FROM sells 
				LEFT JOIN goods ON sells.good_id = goods.id
				GROUP BY good_id Order BY goods.name ASC')->all();


		return $this->render('statistics.twig', ['sells' => $sells, 'sellsall' => $sellsall, 'visitsall' => $visitsall, 'ticketsall' => $ticketsall, 'result' => $result, 'resultmonth' => $resultmonth, 'visitsallmonth' => $visitsallmonth, 'ticketsallmonth' => $ticketsallmonth, 'sellsallmonth' => $sellsallmonth] );
	}





	public function actionPersonsfind($name)
	{
		$name = Persons::find()->joinWith('abonements')->where(['LIKE', 'name', $name])->orWhere(['LIKE', 'second_name', $name])->all();

		return $this->renderPartial('personfind.twig', [
			'name'=>$name 
			]);
	}

	public function actionFormticket($uid){
		$user = Persons::findOne($uid);
		$events = Events::find()->orderBy(['date'=>SORT_ASC])->andwhere('DATE(date) >= DATE(NOW())')->all();
		$end = date("Y-m-d H:i:s");

		return $this->renderPartial('form_ticket.twig', ['user'=>$user, 'end'=>$end, 'events'=>$events]);
	}


	public function actionFormsell($uid){

		$goods = Goods::find()->all();
		$user = Persons::findOne($uid);

		return $this->renderPartial('form_sell.twig', ['goods'=>$goods, 'user'=>$user]);
	}


	public function actionSell($uid){

		$sells = new Sells();
		$sells->user_id = $uid;
		$sells->good_id = $_POST['good_id'];
		$sells->info = $_POST['info'];
		$sells->price = $_POST['price'];
		$sells->count = $_POST['count'];
		$sells->itogo = $_POST['itogo'];
		if(isset($_POST['type'])){
			if($_POST['type'] == 'Наличка'){
				$sells->type = 1;	
			}
			else if($_POST['type'] == 'БезНал'){
				$sells->type = 2;	
			}
			else if($_POST['type'] == 'GoodRepublic'){
				$sells->type = 4;	
			}
			else if($_POST['type'] == 'Не оплачено'){
				$sells->type = 0;	
			}
			else{
				$sells->type = 3;	
			}
		}
		$sells->save();

		return $this->redirect(['persons/index']);
	}


	public function actionVisit($uid){
		$user = Persons::findOne($uid);
		$user->inside = 1;
		$user->save();
		
		$visit = new Visits();
		$visit->user_id = $uid;
		$visit->start = date("Y-m-d H:i:s");
		$visit->save();
		
		return $this->redirect(['persons/index']);
	}


	public function actionVisitabonement($uid){
		$user = Persons::findOne($uid);
		$user->inside = 2;
		$user->save();
		
		$visit = new Visits();
		$visit->user_id = $uid;
		$visit->type = 5;
		$visit->start = date("Y-m-d H:i:s");
		$visit->save();
		
		return $this->redirect(['persons/index']);
	}


	public function actionEndabonement($uid){

		$visit = Visits::find()->where(['user_id'=>$uid])->orderBy(['id'=>SORT_DESC])->one();
		$visit->end = date("Y-m-d H:i:s");

		$visitlast = Visits::find()->where(['user_id'=>$uid])->andwhere(['type'=> 5])->andwhere('DATE(end) = DATE(NOW())')->orderBy(['id'=>SORT_DESC])->one();


		if($visit->save()){
			$user = Persons::findOne($uid);
			$user->inside = 0;
			$user->save();

			$abonement = Abonements::find()->where(['user_id'=>$uid])->andwhere(['status'=>1])->one();
			if($abonement->balance == 1){
				$abonement->status = 0;
			}
			if($visitlast){
			}		
			else{
				$abonement->balance = $abonement->balance - 1;	
			}
		}
		$abonement->save();
		



		return $this->redirect(['persons/index']);
	}



	public function actionVisitend($uid){

		$visit = Visits::find()->where(['user_id'=>$uid])->orderBy(['id'=>SORT_DESC])->one();
		$visit->end = $_POST['end'];
		$visit->discount_money = (int) $_POST['discount_money'];
		$visit->event_id = $_POST['event'];
		$visit->money = $_POST['fin_money'];

		if(isset($_POST['type'])){
			if($_POST['type'] == 'Наличка'){
				$visit->type = 1;	
			}
			else if($_POST['type'] == 'БезНал'){
				$visit->type = 2;	
			}
			else if($_POST['type'] == 'GoodRepublic'){
				$visit->type = 4;	
			}
			else if($_POST['type'] == 'Билетник'){
				$visit->type = 3;	
			}
			else if($_POST['type'] == 'Абонемент'){
				$visit->type = 5;	
			}
			else{
				$visit->type = 6;	
			}
		}

		if($visit->save()){
			$user = Persons::findOne($uid);
			$user->inside = 0;
			$user->save();
		}

		Sells::updateAll(['type' => $visit->type, 'user_id' => $uid], 'type = 0');

		return $this->redirect(['persons/index']);
	}



	public function actionFormendvisit($uid){


		$user = Persons::findOne($uid);
		$events = Events::find()->all();
		$visit = Visits::find()->where(['user_id'=>$uid])->orderBy(['id'=>SORT_DESC])->one();
		$sells = Sells::find()->where(['user_id'=>$uid])->andwhere(['type'=>'0'])->orderBy(['id'=>SORT_DESC])->all();
		$end = date("Y-m-d H:i:s");
		$money = intval((strtotime($end) - strtotime($visit->start))/60)*2;
		$discount_money = (int) (intval((strtotime($end) - strtotime($visit->start))/60)*2/100*$user->discount);
		$fin_money = $money - $discount_money;

		if(($fin_money = $money - $discount_money)<120){
			if($user->discount == 100){
				$fin_money = 0;
			}
			else{
				$fin_money = 120;
			}
		}
		else if(($fin_money = $money - $discount_money)<500){
			$fin_money = $money - $discount_money;	
		}
		else{
			$fin_money = 500;
		}

	// var_dump($sells);
	// return;
		return $this->renderPartial('form_endvisit.twig', ['user'=>$user, 'visit'=>$visit, 'sells'=>$sells, 'end'=>$end, 'discount_money'=>$discount_money, 'fin_money'=>$fin_money, 'money'=>$money , 'events'=>$events ]);
	}






	public function actionView($id){

		$user = Persons::find()->joinWith('visits')->where(['persons.id'=>$id])->one();
		$vis_count = count($user->visits);
		$visitword = VisitsController::pluralForm($vis_count, 'визит', 'визита', 'визитов');
		$summ = Persons::find()->joinWith('visits')->where(['persons.id'=>$id])->sum('money');
		$abonements = Abonements::find()->where(['user_id'=>$id])->all();



		return $this->render('view.twig', [
			'user' => $user, 'visitword' => $visitword, 'summ' => $summ, 'abonements' => $abonements]);

	}


	/**
	 * Creates a new Persons model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Persons();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
				]);
		}
	}




	/**
	 * Creates a new Persons model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreatebegin()
	{
		$model = new Persons();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['viewbegin', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
				]);
		}
	}



	public function actionViewbegin($id){


		$user = Persons::find()->joinWith('visits')->where(['persons.id'=>$id])->one();
		$vis_count = count($user->visits);
		$visitword = VisitsController::pluralForm($vis_count, 'визит', 'визита', 'визитов');
		$summ = Persons::find()->joinWith('visits')->where(['persons.id'=>$id])->sum('money');

		$this->actionVisit($id);

		return $this->render('view.twig', [
			'user' => $user, 'visitword' => $visitword, 'summ' => $summ
			]);

	}



	/**
	 * Creates a new Persons model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionAdd()
	{
		$addperson = new Persons();
		$addperson->name = $_POST['name'];
		$addperson->second_name = $_POST['second_name'];
		$addperson->middle_name = $_POST['middle_name'];
		$addperson->mail = $_POST['mail'];
		$addperson->phone = $_POST['phone'];
		$addperson->birthday = $_POST['birthday'];
		$addperson->status = $_POST['status'];
		$addperson->group = $_POST['group'];
		$addperson->sex = $_POST['sex'];
		$addperson->discount = $_POST['discount'];
		$addperson->froms = $_POST['froms'];
		$addperson->sendmail = $_POST['sendmail'];
		$addperson->info = $_POST['info'];
		$addperson->save();

		return $this->render('create.twig', [
			'addperson' => $addperson,
			]);
	}




	/**
	 * Updates an existing Persons model.
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
	 * Deletes an existing Persons model.
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
	 * Finds the Persons model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Persons the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Persons::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
