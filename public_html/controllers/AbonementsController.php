<?php

namespace app\controllers;

use Yii;
use app\models\Abonements;
use app\models\Persons;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AbonementsController implements the CRUD actions for Abonements model.
 */
class AbonementsController extends Controller
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
     * Lists all Abonements models.
     * @return mixed
     */
    public function actionIndex()
    {

        $abonements = Abonements::find()->joinWith('persons')->where(['abonements.status' => 1])->orderBy(['end'=>SORT_ASC])->all();
        $abonementsold = Abonements::find()->joinWith('persons')->where(['abonements.status' => 0])->orderBy(['end'=>SORT_ASC])->all();
        return $this->render('index.twig', ['abonements' => $abonements, 'abonementsold' => $abonementsold]);

    }

    /**
     * Lists all Abonements models.
     * @return mixed
     */
    public function actionDaycheck()
    {
        $query = "UPDATE abonements SET `status`=0 WHERE DATE(`end`) < DATE(NOW());";
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($query);
        $result = $command->execute();
        var_dump($result);
    }




    /**
     * Displays a single Abonements model.
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
     * Creates a new Abonements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Abonements();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Updates an existing Abonements model.
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
     * Deletes an existing Abonements model.
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
     * Finds the Abonements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Abonements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Abonements::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
